<?php 

namespace App;

use Exception;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionUnionType;

class Container implements ContainerInterface  {
    public array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            if (is_callable($this->entries[$id])) {
                return $entry($this);
            }

            $id = $entry;
            
        }
        return $this->resolve($id);
    }

    public function getConcrete($id) 
    {
        return $this->entries[$id];
    }

    public function has(string $id): bool {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        
        // 1. get the reflection class
        $reflection_class = new ReflectionClass($id);

        // to resolve the db instance once
        if ($id == "App\DB") {
            return DB::instantiate();
        } 


        if (!$reflection_class->isInstantiable()) {
            throw new Exception('class ' . $id . ' is not instaintiable');
        }

        // 2 . get constructor of class from reflection class
        $constuctor = $reflection_class->getConstructor();

        if (! $constuctor) {
            return new $id;
        }
        // 3. get the parameters 
        $parameters = $constuctor->getParameters();

        if (! $parameters) {
            return new $id;
        }

        $dependancies = [];
        
        $dependancies = array_map(function($param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();

            if ($type instanceof ReflectionUnionType) {
                throw new Exception('class ' . $id . ' is not instaintiable');
            }

            if ($type instanceof ReflectionIntersectionType) {
                throw new Exception('class ' . $id . ' is not instaintiable');
            }

            if ($type instanceof ReflectionNamedType && ! $type->isBuiltin()) {
                // instantiate the class using container
                
                return $this->get($type->getName());
            }

        }, $parameters);
        
        

        return $reflection_class->newInstanceArgs($dependancies);
        
    }
}
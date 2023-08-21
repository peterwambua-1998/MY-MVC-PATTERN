<?php 

namespace App;

use Exception;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionUnionType;

class Container implements ContainerInterface  {
    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            
            return $entry($this);
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool {
        return isset($this->entries[$id]);
    }

    public function set(string $id, $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        // 1. get the reflection class
        $reflection_class = new ReflectionClass($id);

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



        foreach ($parameters as $key => $param) {
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
                $r = $this->resolve($type->getName());
                $dependancies[] = $r;
            }

        }

        return $reflection_class->newInstanceArgs($dependancies);
        
    }
}
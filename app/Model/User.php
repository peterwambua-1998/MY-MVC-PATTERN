<?php 

namespace App\Model;


class User extends Model {
    

    public function create(string $name,string $email,bool $isActive = true): int
    {
        
        $builder = $this->db->createQueryBuilder();

        $user = $builder->insert('users')
                        ->values([
                            'email' => '?',
                            'full_name' => '?',
                            'is_active' => '?',
                            'created_at' => '?',
                        ])
                        ->setParameter(0, $email)->setParameter(1, $name)->setParameter(2, $isActive)->setParameter(3, '2023-08-28');

        return (int) $user->executeStatement();
    }

    public static function all() 
    {
        
    }
}
<?php 

namespace App\Model;


class User extends Model {
    

    public function create(string $name,string $email,bool $isActive = true): int
    {
        $db = $this->db->getPDO();
        
        $db->beginTransaction();

        $newUserStmt = $db->prepare(
            'INSERT INTO users (email, full_name, is_active, created_at) VALUES (?,?,?, NOW())'
        );

        $newUserStmt->execute([$email, $name, 1]);
            

        return (int) $db->lastInsertId();
    }
}
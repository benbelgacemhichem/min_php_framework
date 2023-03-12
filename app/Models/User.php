<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public int $id;
    public string $username;
    public string $email;

    public function tablaName(): string {
        return 'users';
    }
    
    public function attributes(): array
    {
        return ['id', 'username', 'email'];
    }
    
}

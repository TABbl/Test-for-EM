<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    public function createUser(string $login, string $email, string $password): User
    {
        return User::create(['login' => $login, 'email' => $email, 'password' => $password]);
    }
}

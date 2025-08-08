<?php

declare(strict_types=1);

namespace App\Services\Users;

use App\Models\User;

class UserRepository
{
    public function getUserByLogin(string $login): ?User
    {
        return User::where('login', $login)->first();
    }
}

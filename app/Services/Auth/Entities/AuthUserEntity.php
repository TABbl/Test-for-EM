<?php

declare(strict_types=1);

namespace App\Services\Auth\Entities;

class AuthUserEntity
{
    public function __construct(
        protected string $login,
        protected string $password,
    ) {}

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

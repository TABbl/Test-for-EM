<?php

declare(strict_types=1);

namespace App\Services\Auth\Entities;

class RegisterUserEntity
{
    public function __construct(
        protected string $login,
        protected string $email,
        protected string $password,
    ) {}

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

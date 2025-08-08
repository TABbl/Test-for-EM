<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use App\Services\Auth\Entities\AuthUserEntity;
use App\Services\Auth\Entities\RegisterUserEntity;
use App\Services\Users\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(private AuthRepository $authRepository, private UserRepository $userRepository)
    {
    }

    public function registerUser(RegisterUserEntity $entity): string
    {
        $user = $this->authRepository->createUser($entity->getLogin(), $entity->getEmail(), $entity->getPassword());
        return $user->createToken($entity->getLogin())->plainTextToken;
    }

    public function createAuthToken(AuthUserEntity $entity): string
    {
        $user = $this->userRepository->getUserByLogin($entity->getLogin());
        if (is_null($user) || !Hash::check($entity->getPassword(), $user->password)) {
            throw new AuthenticationException('Invalid credentials');
        }
        return $user->createToken($entity->getLogin())->plainTextToken;
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Services\Auth\Entities\RegisterUserEntity;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:32', 'unique:users,login'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'numeric', 'min:6'],
        ];
    }

    public function entity(): RegisterUserEntity
    {
        $data = $this->validated();
        return new RegisterUserEntity(
            $data['login'],
            $data['email'],
            $data['password']
        );
    }
}

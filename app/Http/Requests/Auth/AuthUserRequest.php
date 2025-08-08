<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Services\Auth\Entities\AuthUserEntity;
use Illuminate\Foundation\Http\FormRequest;

class AuthUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'exists:users,login'],
            'password' => ['required', 'numeric', 'min:6'],
        ];
    }

    public function entity(): AuthUserEntity
    {
        $data = $this->validated();
        return new AuthUserEntity($data['login'], $data['password']);
    }
}

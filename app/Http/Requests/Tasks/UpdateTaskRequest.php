<?php

declare(strict_types=1);

namespace App\Http\Requests\Tasks;

use App\Enums\Tasks\TaskStatusEnum;
use App\Services\Tasks\Entities\UpdateTaskEntity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:512'],
            'description' => ['nullable', 'string', 'max:2048'],
            'status' => ['nullable', 'string', Rule::in(TaskStatusEnum::getStrings())],
        ];
    }

    public function entity(): UpdateTaskEntity
    {
        $data = $this->validated();
        if (!isset($data['title']) && !isset($data['description']) && !isset($data['status'])) {
            throw new BadRequestHttpException();
        }
        $status = isset($data['status']) ? TaskStatusEnum::fromString($data['status']) : null;
        return new UpdateTaskEntity(
            $data['title'] ?? null,
            $data['description'] ?? null,
            $status,
        );
    }
}

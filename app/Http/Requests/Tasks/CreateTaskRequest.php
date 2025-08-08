<?php

declare(strict_types=1);

namespace App\Http\Requests\Tasks;

use App\Enums\Tasks\TaskStatusEnum;
use App\Services\Tasks\Entities\CreateTaskEntity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:512'],
            'description' => ['nullable', 'string', 'max:2048'],
            'status' => ['nullable', 'string', Rule::in(TaskStatusEnum::getStrings())],
        ];
    }

    public function entity(): CreateTaskEntity
    {
        $data = $this->validated();
        $status = isset($data['status']) ? TaskStatusEnum::fromString($data['status']) : TaskStatusEnum::AWAITING;
        $description = isset($data['description']) ? $data['description'] : null;
        return new CreateTaskEntity(
            $data['title'],
            $description,
            $status,
        );
    }
}

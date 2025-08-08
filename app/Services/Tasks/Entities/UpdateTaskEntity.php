<?php

declare(strict_types=1);

namespace App\Services\Tasks\Entities;

class UpdateTaskEntity
{
    public function __construct(
        protected ?string $title,
        protected ?string $description,
        protected ?int $status,
    ) {}

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getNotNullData(): array
    {
        $data = [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
        ];
        return array_filter($data, fn ($el) => !is_null($el));
    }
}

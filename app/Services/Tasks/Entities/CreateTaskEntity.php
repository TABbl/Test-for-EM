<?php

declare(strict_types=1);

namespace App\Services\Tasks\Entities;

class CreateTaskEntity
{
    public function __construct(
        protected string $title,
        protected ?string $description,
        protected int $status,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}

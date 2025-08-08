<?php

declare(strict_types=1);

namespace App\Repositories\Tasks;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    public function create(int $userId, string $title, ?string $description, int $status): Task
    {
        return Task::create([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'status' => $status,
        ]);
    }

    public function getAllTasks(int $userId): Collection
    {
        return Task::where('user_id', $userId)->get();
    }
}

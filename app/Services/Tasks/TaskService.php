<?php

declare(strict_types=1);

namespace App\Services\Tasks;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Tasks\TaskRepository;
use App\Services\Tasks\Entities\CreateTaskEntity;
use App\Services\Tasks\Entities\UpdateTaskEntity;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function createTask(User $user, CreateTaskEntity $entity): Task
    {
        return $this->taskRepository->create(
            $user->id,
            $entity->getTitle(),
            $entity->getDescription(),
            $entity->getStatus()
        );
    }

    public function updateTask(Task $task, UpdateTaskEntity $entity): Task
    {
        $task->update($entity->getNotNullData());
        \Illuminate\Log\log('UpdatedTask', ['task_id' => $task->id, 'user_id' => $task->user_id]);
        return $task->refresh();
    }

    public function deleteTask(Task $task): void
    {
        $task->delete();
        \Illuminate\Log\log('DeletedTask', ['task_id' => $task->id, 'user_id' => $task->user_id]);
    }

    public function getAllTasks(User $user): Collection
    {
        return $this->taskRepository->getAllTasks($user->id);
    }
}

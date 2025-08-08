<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\Tasks\TaskResource;
use App\Models\Task;
use App\Services\Tasks\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TaskController extends Controller
{
    public function __construct(
        private TaskService  $taskService,
    )
    {
    }

    public function createTask(CreateTaskRequest $request): TaskResource
    {
        $user = $request->user();
        $entity = $request->entity();
        $task = $this->taskService->createTask($user, $entity);
        return (new TaskResource($task));
    }

    public function getTask(Task $task, Request $request): TaskResource
    {
        $user = $request->user();
        if ($task->user_id !== $user->id) {
            throw new AccessDeniedHttpException();
        }
        return new TaskResource($task);
    }

    public function getAllTasks(Request $request): AnonymousResourceCollection
    {
        $user = $request->user();
        $tasks = $this->taskService->getAllTasks($user);
        return TaskResource::collection($tasks);
    }

    public function updateTask(Task $task, UpdateTaskRequest $request): TaskResource
    {
        $user = $request->user();
        if ($task->user_id !== $user->id) {
            throw new AccessDeniedHttpException();
        }
        $entity = $request->entity();
        return new TaskResource($this->taskService->updateTask($task, $entity));
    }

    public function deleteTask(Task $task, Request $request): JsonResponse
    {
        $user = $request->user();
        if ($task->user_id !== $user->id) {
            throw new AccessDeniedHttpException();
        }
        $this->taskService->deleteTask($task);
        return response()->json([], 202);
    }
}

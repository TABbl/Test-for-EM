<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Tasks;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testSuccess(): void
    {
        $user = User::first();
        $taskId = $user->tasks()->first()->id;
        Sanctum::actingAs($user);
        $response = $this->delete('/api/tasks/' . $taskId);
        $response->assertAccepted();
    }

    public function testUnauthorized(): void
    {
        $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'awaiting',
        ])->assertUnauthorized();
    }
}

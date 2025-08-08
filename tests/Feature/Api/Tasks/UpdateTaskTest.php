<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Tasks;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testSuccess(): void
    {
        $user = User::first();
        $taskId = $user->tasks()->first()->id;
        Sanctum::actingAs($user);
        $response = $this->putJson('/api/tasks/'.$taskId, [
            'title' => 'Update Title',
            'description' => 'Update Description',
            'status' => 'in_progress',
        ]);
        $response->assertOk()->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'status'],
        ]);
    }

    public function testUnauthorized(): void
    {
        $taskId = User::first()->tasks()->first()->id;
        $this->putJson('/api/tasks/'.$taskId, [
            'title' => 'Update Title',
            'description' => 'Update Description',
            'status' => 'in_progress',
        ])->assertUnauthorized();
    }
}

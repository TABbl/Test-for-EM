<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Tasks;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testSuccess(): void
    {
        $user = User::first();
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'awaiting',
        ]);
        $response->assertCreated()->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'status'],
        ]);
    }

    public function testEmptyTitle()
    {
        $user = User::first();
        Sanctum::actingAs($user);
        $response = $this->postJson('/api/tasks', [
            'description' => 'Test Description',
            'status' => 'awaiting',
        ]);
        $response->assertUnprocessable();
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

<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Tasks;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetTaskTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testSuccess(): void
    {
        $user = User::first();
        $taskId = $user->tasks()->first()->id;
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/tasks/'.$taskId);
        $response->assertOk()->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'status'],
        ]);
    }

    public function testUnauthorized(): void
    {
        $taskId = User::first()->tasks()->first()->id;
        $this->getJson('/api/tasks/'.$taskId)->assertUnauthorized();
    }
}

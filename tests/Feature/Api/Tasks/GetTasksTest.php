<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Tasks;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetTasksTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testSuccess(): void
    {
        $user = User::first();
        Sanctum::actingAs($user);
        $response = $this->getJson('/api/tasks/');
        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'description', 'status'],
            ],
        ]);
    }

    public function testUnauthorized(): void
    {
        $this->getJson('/api/tasks/')->assertUnauthorized();
    }
}

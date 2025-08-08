<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run(): void
    {
        $insertArr = [];
        $userIds = User::get()->pluck('id')->toArray();
        foreach ($userIds as $userId) {
            $insertArr[] = [
                'user_id' => $userId,
                'title' => fake()->title,
                'description' => fake()->text(300),
                'status' => random_int(1, 3),
            ];
        }
        Task::insert($insertArr);
    }
}

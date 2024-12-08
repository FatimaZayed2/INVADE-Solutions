<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Task 1',
            'description' => 'description 1',
            'status' => 'pending',
            'category' => 'Work',
            'due_date' => '2023-12-31',

        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'description  2',
            'status' => 'completed',
            'category' => 'Personal',
            'due_date' => '2023-12-31',
        ]);
    }
}

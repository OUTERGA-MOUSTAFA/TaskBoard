<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'title' => fake()->name() ,
            // 'description' => 'This is the description for the first task.',
            // 'statut' => 'To do',
            // 'priority' => Random('hight','low','meduim'),
            // 'deadline' => now()->addDays(7),
            // 'user_id' => integerValue::rand(10),
            
        ];
        
    }
}

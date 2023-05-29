<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExercisesList>
 */
class ExercisesListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teacher_id =  User::where('role', '=', 'teacher')->inRandomOrder()->first()->id;

        return [
            'file_name' => fake()->word(),
            'base_path' => fake()->filePath(),
            'name' => fake()->text(16),
            'description' => fake()->text(255),
            //'images' => json_encode([fake()->filePath(), fake()->filePath()]),
            'points' => random_int(1, 100),
            'initiation' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'deadline' => fake()->dateTimeBetween('+1 month', '+3 months'),
            'is_active' => fake()->boolean,
            'created_by' => $teacher_id,
            'updated_by' => $teacher_id,
        ];
    }
}

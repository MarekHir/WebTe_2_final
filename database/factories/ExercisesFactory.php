<?php

namespace Database\Factories;

use App\Models\ExercisesList;
use App\Models\ExercisesListsSection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercises>
 */
class ExercisesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exercises_lists_sections =  ExercisesListsSection::inRandomOrder()->first();
        $student_id =  User::where('role', '=', 'student')->inRandomOrder()->first()->id;
        $fakedBoolean = fake()->boolean;

        return [
            'points' => $fakedBoolean ? fake()->numberBetween(1, $exercises_lists_sections->exercisesLists->points) : null,
            'solved' => $fakedBoolean,
            'description' => fake()->text(255),
            'exercises_lists_sections_id' => $exercises_lists_sections->id,
            'solution' => 'y(t)=\dfrac{1}{12} - \dfrac{3}{2}e^{-t} + \dfrac{1}{6}e^{-3t} + \dfrac{1}{4}e^{-4t} = 0.0833 -1.5 e^{-t} + 0.1666 e^{-3t} + 0.25 e^{-4t}',
            'created_by' => $student_id,
            'updated_by' => $student_id,
            ];
    }
}

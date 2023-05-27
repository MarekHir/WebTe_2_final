<?php

namespace Database\Factories;

use App\Models\ExercisesList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExercisesListsSection>
 */
class ExercisesListsSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exercises_lists_id =  ExercisesList::inRandomOrder()->first()->id;

        return [
            'section_title' => fake()->title(),
            'task' => fake()->text(255),
            'solution' => '((1/12 - 3/2/et) + 1/(6*e(3t))) + 1/(4e*(4t))',
            //'picture_name' => fake()->unique()->pictureName(),
            'exercises_lists_id' => $exercises_lists_id,
        ];
    }
}

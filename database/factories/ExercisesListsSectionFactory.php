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
            'solution' => 'y(t)=\left[ \dfrac{7}{5}-\dfrac{7}{5}e^{-\frac{5}{2}(t-6)}-\dfrac{7}{2}(t-6)e^{-\frac{5}{2}(t-6)} \right] \eta(t-6)',
            //'picture_name' => fake()->unique()->pictureName(),
            'exercises_lists_id' => $exercises_lists_id,
        ];
    }
}

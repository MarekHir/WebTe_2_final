<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    private $random_icon_links = [
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-2.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-3.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-5.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-6.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-7.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-8.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-9.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-10.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-11.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-12.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-13.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-14.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-15.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-16.jpg',
        'https://icon-library.com/images/avatar-icon-images/avatar-icon-images-17.jpg',
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'student',
            'icon' => $this->random_icon_links[array_rand($this->random_icon_links)],
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }


    public function student(): static
    {
        return $this;
    }
    public function teacher(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'teacher',
        ]);
    }
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }
}

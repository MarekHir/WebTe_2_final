<?php

namespace Database\Seeders;

use App\Models\Exercises;
use App\Models\ExercisesList;
use App\Models\ExercisesListsSection;
use App\Models\Instructions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default users initialization
        User::factory(1)->admin()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
        ]);
        User::factory(1)->teacher()->create([
            'email' => 'teacher@example.com',
            'password' => Hash::make('teacherpassword'),
        ]);
        User::factory(1)->student()->create([
            'email' => 'student@example.com',
            'password' => Hash::make('studentpassword'),
        ]);

        // Random students and teachers initialization
        User::factory(20)->student()->create();
        User::factory(3)->teacher()->create();
        Instructions::factory()->studentSlovak()->create();
        Instructions::factory()->studentEnglish()->create();
        Instructions::factory()->teacherSlovak()->create();
        Instructions::factory()->teacherEnglish()->create();

        // Default exercises initialization
        ExercisesList::factory(30)->create();
        ExercisesListsSection::factory(90)->create();
        Exercises::factory(180)->create();
    }
}

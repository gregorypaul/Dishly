<?php

namespace Database\Seeders;
use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::first(); // your first user
        $user2 = User::skip(1)->first(); // maybe a second user

        Recipe::create([
            'title' => 'Spaghetti Bolognese',
            'description' => 'Classic Italian pasta dish',
            'ingredients' => 'Spaghetti, beef, tomato sauce',
            'instructions' => 'Boil pasta, cook beef, mix with sauce.',
            'user_id' => $user1->id,
        ]);

        Recipe::create([
            'title' => 'Chicken Curry',
            'description' => 'Spicy curry with chicken and rice',
            'ingredients' => 'Chicken, curry paste, coconut milk',
            'instructions' => 'Cook chicken, add paste and coconut milk.',
            'user_id' => $user2->id,
        ]);
    }
}

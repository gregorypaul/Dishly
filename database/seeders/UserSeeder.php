<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a normal user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@myrecipebook.com',
        ])->assignRole('admin');

        // Regular user
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@myrecipebook.com',
            'password' => bcrypt('password'),
        ])->assignRole('user');

        // Extra random users
        User::factory(3)->create()->each(fn ($u) => $u->assignRole('user'));
    }
}
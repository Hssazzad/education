<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 🔹 Fixed User
        User::factory()->create([
            'name' => 'Sazzad',
            'email' => 'sazzad@example.com',
            'password' => Hash::make('12345678') // fixed password
        ]);

        // 🔹 10 faker users
        User::factory(10)->create();

        // 🔹 Categories
        $categories = ['Technology', 'Health', 'Lifestyle', 'Education', 'Entertainment'];
        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }

        // 🔹 50 posts
        Post::factory(50)->create();
    }
}

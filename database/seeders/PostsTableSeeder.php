<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all user IDs from the users table
        $userIds = User::pluck('id')->toArray();

        // Generate 10 fake posts
        foreach (range(1, 10) as $index) {
            DB::table('posts')->insert([
                'user_id' => $faker->randomElement($userIds),  // Reference a random user ID
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'image' => $faker->imageUrl(640, 480, 'posts', true), // Optional image URL
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }    
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Desk;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        Desk::truncate();
        Category::truncate();
        Event::truncate();

        Desk::factory(10)->has(User::factory(10))->create();
        Category::factory(10)->create();

        Event::factory()->create([
            "user_id" => 1,
            "category_id" => 1,
        ]);
        Event::factory()->create([
            "user_id" => 2,
            "category_id" => 2,
        ]);
        Event::factory()->create([
            "user_id" => 3,
            "category_id" => 3,
        ]);
        Event::factory()->create([
            "user_id" => 4,
            "category_id" => 4,
        ]);
        Event::factory()->create([
            "user_id" => 5,
            "category_id" => 5,
        ]);
    }
    }


<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Database\Factories\PostFactory;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$users = User::factory()->count(10)->create();

        $books = Book::factory()->count(10)->create();
    }
}

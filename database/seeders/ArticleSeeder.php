<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $categories = Category::all();

        // Pastikan ada pengguna dan kategori
        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Please seed users and categories first.');
            return;
        }

        // Buat 10 artikel
        Article::factory(10)->create([
            'user_id' => $users->random()->id,
            'category_id' => $categories->random()->id,
        ]);
    }
}

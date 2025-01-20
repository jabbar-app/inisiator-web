<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Jabbar A. Panggabean',
            'username' => 'jabbarp_',
            'phone' => '628990980799',
            'email' => 'jabbar@lomba.id',
            'password' => bcrypt('bism!LLAH99'),
            'role' => 'admin',
        ]);

        User::factory(10)->create();

        $categories = [
            [
                'title' => 'Teknologi',
                'slug' => 'teknologi',
                'content' => '<h2>Teknologi</h2><p>Teknologi adalah kategori yang membahas perkembangan dunia digital, inovasi perangkat lunak, hardware, serta tren teknologi terkini. Anda dapat menemukan informasi seputar AI, IoT, pengembangan aplikasi, hingga teknologi blockchain.</p>',
                'meta_description' => 'Artikel terkini tentang dunia teknologi, inovasi digital, dan tren terbaru.',
                'color' => 'info',
            ],
            [
                'title' => 'Kesehatan',
                'slug' => 'kesehatan',
                'content' => '<h2>Kesehatan</h2><p>Kategori Kesehatan memberikan wawasan tentang pola hidup sehat, penyakit umum, pengobatan, dan informasi medis yang dapat membantu Anda meningkatkan kualitas hidup.</p>',
                'meta_description' => 'Dapatkan informasi terbaru tentang kesehatan, gaya hidup sehat, dan pengobatan.',
                'color' => 'success',
            ],
            [
                'title' => 'Edukasi',
                'slug' => 'edukasi',
                'content' => '<h2>Edukasi</h2><p>Kategori Edukasi menyediakan informasi tentang pembelajaran, metode belajar efektif, panduan beasiswa, dan tips sukses di dunia akademik serta karir.</p>',
                'meta_description' => 'Panduan belajar efektif, tips beasiswa, dan informasi seputar dunia pendidikan.',
                'color' => 'primary',
            ],
            [
                'title' => 'Bisnis dan Keuangan',
                'slug' => 'bisnis-keuangan',
                'content' => '<h2>Bisnis dan Keuangan</h2><p>Kategori ini membahas strategi bisnis, pengelolaan keuangan, investasi, dan cara meningkatkan pendapatan melalui berbagai peluang usaha.</p>',
                'meta_description' => 'Temukan artikel tentang strategi bisnis, investasi, dan tips pengelolaan keuangan.',
                'color' => 'warning',
            ],
            [
                'title' => 'Hiburan',
                'slug' => 'hiburan',
                'content' => '<h2>Hiburan</h2><p>Kategori Hiburan mencakup ulasan film, musik, game, acara TV, dan berita terkini dari dunia hiburan untuk menemani waktu santai Anda.</p>',
                'meta_description' => 'Berita terkini dari dunia hiburan: ulasan film, musik, game, dan acara TV.',
                'color' => 'danger',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // $this->call([
        //     ArticleSeeder::class,
        // ]);
    }
}

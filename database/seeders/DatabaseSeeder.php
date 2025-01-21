<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
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
            'role' => 'admin',
            'name' => 'Jabbar A. Panggabean',
            'username' => 'jabbarp_',
            'phone' => '628990980799',
            'email' => 'jabbar@lomba.id',
            'password' => bcrypt('bism!LLAH99'),
            'referral_code' => 'MY915LOV',
            'is_verified' => true,
        ]);

        $categories = [
            [
                'title' => 'Kisah Inspiratif',
                'slug' => Str::slug('Kisah Inspiratif'),
                'content' => '<h2>Kisah Inspiratif</h2><p>Kategori ini menghadirkan cerita perjalanan hidup, kisah sukses, dan pelajaran berharga dari berbagai pengalaman nyata yang menginspirasi.</p>',
                'meta_description' => 'Kisah inspiratif yang memotivasi dan memberikan pelajaran hidup.',
                'color' => 'success',
            ],
            [
                'title' => 'Hubungan dan Kehidupan',
                'slug' => Str::slug('Hubungan dan Kehidupan'),
                'content' => '<h2>Hubungan dan Kehidupan</h2><p>Kategori ini membahas cinta, keluarga, persahabatan, dan berbagai cerita emosional yang relatable dengan kehidupan sehari-hari.</p>',
                'meta_description' => 'Cerita tentang cinta, keluarga, dan hubungan emosional dalam kehidupan.',
                'color' => 'primary',
            ],
            [
                'title' => 'Misteri dan Konspirasi',
                'slug' => Str::slug('Misteri dan Konspirasi'),
                'content' => '<h2>Misteri dan Konspirasi</h2><p>Kategori ini menyajikan cerita penuh teka-teki, teori konspirasi, dan kisah yang memicu rasa ingin tahu Anda.</p>',
                'meta_description' => 'Temukan cerita misteri dan teori konspirasi yang memikat.',
                'color' => 'info',
            ],
            [
                'title' => 'Psikologi dan Emosi',
                'slug' => Str::slug('Psikologi dan Emosi'),
                'content' => '<h2>Psikologi dan Emosi</h2><p>Kategori ini membahas kesehatan mental, pengembangan diri, dan cara memahami emosi untuk kehidupan yang lebih baik.</p>',
                'meta_description' => 'Artikel tentang psikologi, kesehatan mental, dan pengembangan diri.',
                'color' => 'warning',
            ],
            [
                'title' => 'Cerita Sejarah dan Budaya',
                'slug' => Str::slug('Cerita Sejarah dan Budaya'),
                'content' => '<h2>Cerita Sejarah dan Budaya</h2><p>Kategori ini mengeksplorasi cerita-cerita bersejarah, asal-usul budaya, dan tradisi yang menarik.</p>',
                'meta_description' => 'Eksplorasi cerita sejarah dan budaya dari berbagai penjuru dunia.',
                'color' => 'danger',
            ],
            [
                'title' => 'Kisah Horor dan Supranatural',
                'slug' => Str::slug('Kisah Horor dan Supranatural'),
                'content' => '<h2>Kisah Horor dan Supranatural</h2><p>Kategori ini menghadirkan pengalaman mistis, cerita seram, dan legenda urban yang memacu adrenalin.</p>',
                'meta_description' => 'Nikmati kisah horor dan pengalaman supranatural yang menegangkan.',
                'color' => 'dark',
            ],
            [
                'title' => 'Teknologi dan Masa Depan',
                'slug' => Str::slug('Teknologi dan Masa Depan'),
                'content' => '<h2>Teknologi dan Masa Depan</h2><p>Kategori ini membahas perkembangan teknologi, inovasi digital, dan prediksi masa depan.</p>',
                'meta_description' => 'Informasi terbaru tentang teknologi dan inovasi masa depan.',
                'color' => 'info',
            ],
            [
                'title' => 'Perjalanan dan Eksplorasi',
                'slug' => Str::slug('Perjalanan dan Eksplorasi'),
                'content' => '<h2>Perjalanan dan Eksplorasi</h2><p>Kategori ini membawa Anda ke tempat-tempat tersembunyi, pengalaman budaya, dan petualangan seru dari berbagai belahan dunia.</p>',
                'meta_description' => 'Cerita perjalanan dan eksplorasi ke tempat-tempat menarik di dunia.',
                'color' => 'success',
            ],
            [
                'title' => 'Cerita Fiksi yang Membekas',
                'slug' => Str::slug('Cerita Fiksi yang Membekas'),
                'content' => '<h2>Cerita Fiksi yang Membekas</h2><p>Kategori ini menyajikan cerita pendek, fiksi bersambung, dan kisah-kisah imajinatif yang menggugah emosi.</p>',
                'meta_description' => 'Nikmati cerita fiksi yang menarik dan penuh imajinasi.',
                'color' => 'primary',
            ],
            [
                'title' => 'Konten Edukatif dan Informatif',
                'slug' => Str::slug('Konten Edukatif dan Informatif'),
                'content' => '<h2>Konten Edukatif dan Informatif</h2><p>Kategori ini menyediakan panduan belajar, tips sukses, dan insight mendalam untuk meningkatkan pengetahuan Anda.</p>',
                'meta_description' => 'Artikel edukatif yang informatif untuk meningkatkan wawasan Anda.',
                'color' => 'warning',
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

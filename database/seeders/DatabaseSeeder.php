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
                'title' => 'Luminary', // Inspirasi dan motivasi
                'slug' => Str::slug('Luminary'),
                'content' => '<h2>Luminary</h2><p>Discover inspiring life stories, success journeys, and valuable lessons that motivate and enlighten. <br>Temukan kisah inspiratif, perjalanan menuju sukses, dan pelajaran berharga yang memotivasi dan mencerahkan.</p>',
                'meta_description' => 'Inspirational stories and life lessons to brighten your day. Kisah motivasi yang menginspirasi.',
                'color' => 'success',
            ],
            [
                'title' => 'Elysian', // Keindahan hubungan
                'slug' => Str::slug('Elysian'),
                'content' => '<h2>Elysian</h2><p>Explore the beauty of relationships, love, and emotional connections that shape our lives. <br>Eksplorasi keindahan hubungan, cinta, dan koneksi emosional yang membentuk hidup kita.</p>',
                'meta_description' => 'Heartwarming stories about love, family, and relationships. Cerita tentang cinta dan keluarga.',
                'color' => 'primary',
            ],
            [
                'title' => 'Obscura', // Misteri dan teka-teki
                'slug' => Str::slug('Obscura'),
                'content' => '<h2>Obscura</h2><p>Dive into mysteries, conspiracies, and untold stories that spark curiosity. <br>Telusuri misteri, konspirasi, dan cerita tersembunyi yang memancing rasa ingin tahu Anda.</p>',
                'meta_description' => 'Mysterious stories and intriguing conspiracies. Kisah misteri yang menggugah rasa penasaran.',
                'color' => 'info',
            ],
            [
                'title' => 'Sanctum', // Refleksi batin
                'slug' => Str::slug('Sanctum'),
                'content' => '<h2>Sanctum</h2><p>Delve into mental health, self-improvement, and understanding emotions for a better life. <br>Mendalami kesehatan mental, pengembangan diri, dan cara memahami emosi untuk hidup yang lebih baik.</p>',
                'meta_description' => 'Insights on mental health and personal growth. Panduan kesehatan mental dan pengembangan diri.',
                'color' => 'warning',
            ],
            [
                'title' => 'Anecdota', // Sejarah dan budaya
                'slug' => Str::slug('Anecdota'),
                'content' => '<h2>Anecdota</h2><p>Uncover historical tales, cultural origins, and timeless traditions from around the world. <br>Temukan kisah sejarah, asal-usul budaya, dan tradisi yang tak lekang oleh waktu dari berbagai penjuru dunia.</p>',
                'meta_description' => 'Stories of history and culture. Cerita sejarah dan budaya yang menarik.',
                'color' => 'danger',
            ],
            [
                'title' => 'Phantom', // Horor dan supranatural
                'slug' => Str::slug('Phantom'),
                'content' => '<h2>Phantom</h2><p>Experience ghost stories, urban legends, and supernatural encounters. <br>Rasakan kisah hantu, legenda urban, dan pengalaman supranatural yang menegangkan.</p>',
                'meta_description' => 'Ghost stories and supernatural encounters. Kisah hantu dan pengalaman mistis.',
                'color' => 'dark',
            ],
            [
                'title' => 'Nexus', // Teknologi dan inovasi
                'slug' => Str::slug('Nexus'),
                'content' => '<h2>Nexus</h2><p>Explore the latest tech trends, digital innovation, and future possibilities. <br>Eksplorasi tren teknologi terbaru, inovasi digital, dan kemungkinan masa depan.</p>',
                'meta_description' => 'Latest tech and innovations. Tren teknologi dan inovasi masa depan.',
                'color' => 'info',
            ],
            [
                'title' => 'Odyssey', // Petualangan dan eksplorasi
                'slug' => Str::slug('Odyssey'),
                'content' => '<h2>Odyssey</h2><p>Embark on adventures, explore hidden gems, and experience thrilling journeys worldwide. <br>Mulai petualangan, jelajahi tempat tersembunyi, dan nikmati perjalanan seru di seluruh dunia.</p>',
                'meta_description' => 'Travel stories and explorations. Cerita petualangan dan eksplorasi seru.',
                'color' => 'success',
            ],
            [
                'title' => 'Fable', // Cerita fiksi
                'slug' => Str::slug('Fable'),
                'content' => '<h2>Fable</h2><p>Immerse yourself in imaginative tales, gripping narratives, and creative fiction. <br>Masuki dunia kisah imajinatif, narasi yang mendalam, dan cerita fiksi yang menarik.</p>',
                'meta_description' => 'Imaginative tales and gripping fiction. Cerita fiksi yang memikat.',
                'color' => 'primary',
            ],
            [
                'title' => 'Mentor', // Edukasi dan wawasan
                'slug' => Str::slug('Mentor'),
                'content' => '<h2>Mentor</h2><p>Gain educational insights, practical tips, and informative guides for personal growth. <br>Dapatkan wawasan edukatif, tips praktis, dan panduan informatif untuk pengembangan diri.</p>',
                'meta_description' => 'Educational articles and guides. Artikel edukatif untuk pengembangan wawasan.',
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

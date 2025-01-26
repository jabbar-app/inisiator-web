<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Article;
use App\Models\DareTemplate;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin
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

        // Buat kategori
        $categories = [
            [
                'title' => 'Inspiration and motivation',
                'slug' => Str::slug('Luminary'),
                'content' => '<h2>Luminary</h2><p>Discover inspiring life stories, success journeys, and valuable lessons that motivate and enlighten.</p>',
                'meta_description' => 'Inspirational stories and life lessons to brighten your day.',
                'color' => 'success',
            ],
            [
                'title' => 'The beauty of relationships',
                'slug' => Str::slug('Elysian'),
                'content' => '<h2>Elysian</h2><p>Explore the beauty of relationships, love, and emotional connections that shape our lives.</p>',
                'meta_description' => 'Heartwarming stories about love, family, and relationships.',
                'color' => 'primary',
            ],
            [
                'title' => 'Mystery and puzzles',
                'slug' => Str::slug('Obscura'),
                'content' => '<h2>Obscura</h2><p>Dive into mysteries, conspiracies, and untold stories that spark curiosity.</p>',
                'meta_description' => 'Mysterious stories and intriguing conspiracies.',
                'color' => 'info',
            ],
            [
                'title' => 'Inner reflections',
                'slug' => Str::slug('Sanctum'),
                'content' => '<h2>Sanctum</h2><p>Delve into mental health, self-improvement, and understanding emotions for a better life.</p>',
                'meta_description' => 'Insights on mental health and personal growth.',
                'color' => 'warning',
            ],
            [
                'title' => 'History and culture',
                'slug' => Str::slug('Anecdota'),
                'content' => '<h2>Anecdota</h2><p>Uncover historical tales, cultural origins, and timeless traditions from around the world.</p>',
                'meta_description' => 'Stories of history and culture.',
                'color' => 'danger',
            ],
            [
                'title' => 'Horror and supernatural',
                'slug' => Str::slug('Phantom'),
                'content' => '<h2>Phantom</h2><p>Experience ghost stories, urban legends, and supernatural encounters.</p>',
                'meta_description' => 'Ghost stories and supernatural encounters.',
                'color' => 'dark',
            ],
            [
                'title' => 'Technology and innovation',
                'slug' => Str::slug('Nexus'),
                'content' => '<h2>Nexus</h2><p>Explore the latest tech trends, digital innovation, and future possibilities.</p>',
                'meta_description' => 'Latest tech and innovations.',
                'color' => 'info',
            ],
            [
                'title' => 'Adventure and exploration',
                'slug' => Str::slug('Odyssey'),
                'content' => '<h2>Odyssey</h2><p>Embark on adventures, explore hidden gems, and experience thrilling journeys worldwide.</p>',
                'meta_description' => 'Travel stories and explorations.',
                'color' => 'success',
            ],
            [
                'title' => 'Fiction stories',
                'slug' => Str::slug('Fable'),
                'content' => '<h2>Fable</h2><p>Immerse yourself in imaginative tales, gripping narratives, and creative fiction.</p>',
                'meta_description' => 'Imaginative tales and gripping fiction.',
                'color' => 'primary',
            ],
            [
                'title' => 'Education and insights',
                'slug' => Str::slug('Mentor'),
                'content' => '<h2>Mentor</h2><p>Gain educational insights, practical tips, and informative guides for personal growth.</p>',
                'meta_description' => 'Educational articles and guides.',
                'color' => 'warning',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $templates = [
            [
                'question' => 'Apa warna favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Merah', 'is_image' => false],
                    ['text' => 'Biru', 'is_image' => false],
                    ['text' => 'Hijau', 'is_image' => false],
                    ['text' => 'Kuning', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa makanan favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Pizza', 'is_image' => false],
                    ['text' => 'Sate', 'is_image' => false],
                    ['text' => 'Bakso', 'is_image' => false],
                    ['text' => 'Rendang', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa minuman favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Teh', 'is_image' => false],
                    ['text' => 'Kopi', 'is_image' => false],
                    ['text' => 'Susu', 'is_image' => false],
                    ['text' => 'Jus Jeruk', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa hobi favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Membaca', 'is_image' => false],
                    ['text' => 'Menulis', 'is_image' => false],
                    ['text' => 'Berolahraga', 'is_image' => false],
                    ['text' => 'Bermain Musik', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa tempat liburan impian {name}?',
                'options' => json_encode([
                    ['text' => 'Bali', 'is_image' => false],
                    ['text' => 'Paris', 'is_image' => false],
                    ['text' => 'Tokyo', 'is_image' => false],
                    ['text' => 'New York', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Siapa tokoh idola {name}?',
                'options' => json_encode([
                    ['text' => 'Albert Einstein', 'is_image' => false],
                    ['text' => 'Soekarno', 'is_image' => false],
                    ['text' => 'Oprah Winfrey', 'is_image' => false],
                    ['text' => 'Elon Musk', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa film favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Inception', 'is_image' => false],
                    ['text' => 'Titanic', 'is_image' => false],
                    ['text' => 'Avengers: Endgame', 'is_image' => false],
                    ['text' => 'Parasite', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa hewan peliharaan yang disukai {name}?',
                'options' => json_encode([
                    ['text' => 'Anjing', 'is_image' => false],
                    ['text' => 'Kucing', 'is_image' => false],
                    ['text' => 'Burung', 'is_image' => false],
                    ['text' => 'Ikan', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa pekerjaan impian {name}?',
                'options' => json_encode([
                    ['text' => 'Dokter', 'is_image' => false],
                    ['text' => 'Insinyur', 'is_image' => false],
                    ['text' => 'Seniman', 'is_image' => false],
                    ['text' => 'Pengusaha', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa genre musik favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Pop', 'is_image' => false],
                    ['text' => 'Rock', 'is_image' => false],
                    ['text' => 'Jazz', 'is_image' => false],
                    ['text' => 'Klasik', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa aktivitas akhir pekan favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Menonton Film', 'is_image' => false],
                    ['text' => 'Jalan-Jalan', 'is_image' => false],
                    ['text' => 'Tidur', 'is_image' => false],
                    ['text' => 'Membaca Buku', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa mata pelajaran yang paling disukai {name}?',
                'options' => json_encode([
                    ['text' => 'Matematika', 'is_image' => false],
                    ['text' => 'Fisika', 'is_image' => false],
                    ['text' => 'Sejarah', 'is_image' => false],
                    ['text' => 'Bahasa Inggris', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa minuman favorit {name} di pagi hari?',
                'options' => json_encode([
                    ['text' => 'Kopi', 'is_image' => false],
                    ['text' => 'Teh', 'is_image' => false],
                    ['text' => 'Susu', 'is_image' => false],
                    ['text' => 'Air Putih', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa tempat favorit {name} untuk bersantai?',
                'options' => json_encode([
                    ['text' => 'Pantai', 'is_image' => false],
                    ['text' => 'Pegunungan', 'is_image' => false],
                    ['text' => 'Taman Kota', 'is_image' => false],
                    ['text' => 'Kafe', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa waktu tidur favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Pagi', 'is_image' => false],
                    ['text' => 'Siang', 'is_image' => false],
                    ['text' => 'Malam', 'is_image' => false],
                    ['text' => 'Tengah Malam', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa olahraga yang paling disukai {name}?',
                'options' => json_encode([
                    ['text' => 'Sepak Bola', 'is_image' => false],
                    ['text' => 'Bulu Tangkis', 'is_image' => false],
                    ['text' => 'Berenang', 'is_image' => false],
                    ['text' => 'Lari', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Siapa artis favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Raisa', 'is_image' => false],
                    ['text' => 'Ariel Noah', 'is_image' => false],
                    ['text' => 'Agnez Mo', 'is_image' => false],
                    ['text' => 'Tulus', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa jenis liburan favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Liburan ke Kota', 'is_image' => false],
                    ['text' => 'Liburan ke Alam', 'is_image' => false],
                    ['text' => 'Staycation', 'is_image' => false],
                    ['text' => 'Wisata Kuliner', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa jenis buku favorit {name}?',
                'options' => json_encode([
                    ['text' => 'Novel', 'is_image' => false],
                    ['text' => 'Komik', 'is_image' => false],
                    ['text' => 'Biografi', 'is_image' => false],
                    ['text' => 'Buku Pelajaran', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang paling sering dilakukan {name} di waktu luang?',
                'options' => json_encode([
                    ['text' => 'Mendengarkan Musik', 'is_image' => false],
                    ['text' => 'Bermain Game', 'is_image' => false],
                    ['text' => 'Menonton Film', 'is_image' => false],
                    ['text' => 'Tidur Siang', 'is_image' => false],
                ]),
            ],
        ];

        foreach ($templates as $template) {
            DareTemplate::create($template);
        }

        // Buat artikel
        $articles = [];
        for ($i = 1; $i <= 20; $i++) {
            $articles[] = [
                'user_id' => 1,
                'category_id' => rand(1, count($categories)),
                'img_featured' => 'featured-images/1737443688-678f496810039.webp',
                'title' => 'Sample Article ' . $i,
                'slug' => 'sample-article-' . $i,
                'content' => '<p>This is a sample content for article ' . $i . '</p>',
                'excerpt' => 'This is a sample excerpt for article ' . $i,
                'reading_time' => rand(2, 10),
                'earnings' => rand(0, 500) / 10,
                'is_featured' => rand(0, 1),
                'is_highlighted' => rand(0, 1),
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Article::insert($articles);
    }
}

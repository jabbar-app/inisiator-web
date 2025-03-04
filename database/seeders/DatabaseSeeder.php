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
            'phone' => '6289909807994',
            'email' => 'jabbar@lomba.id',
            'password' => bcrypt('bism!LLAH99'),
            'referral_code' => 'MY915LOV',
            'is_verified' => true,
        ]);

        // Buat kategori
        $categories = [
            [
                'title' => 'Inspiration and Motivation',
                'slug' => Str::slug('Inspiration and Motivation'),
                'content' => '<h2>Inspiration and Motivation</h2><p>Discover inspiring life stories, success journeys, and valuable lessons that motivate and enlighten. Find the spark you need to achieve your dreams.</p>',
                'meta_description' => 'Get inspired with real-life stories, success journeys, and motivational lessons to brighten your day.',
                'color' => 'success',
            ],
            [
                'title' => 'The Beauty of Relationships',
                'slug' => Str::slug('The Beauty of Relationships'),
                'content' => '<h2>The Beauty of Relationships</h2><p>Explore the beauty of relationships, love, and emotional connections that shape our lives. Learn how to nurture meaningful bonds.</p>',
                'meta_description' => 'Heartwarming stories about love, family, and relationships that touch your soul.',
                'color' => 'primary',
            ],
            [
                'title' => 'Mystery and Puzzles',
                'slug' => Str::slug('Mystery and Puzzles'),
                'content' => '<h2>Mystery and Puzzles</h2><p>Dive into mysteries, conspiracies, and untold stories that spark curiosity. Unravel the unknown and challenge your mind.</p>',
                'meta_description' => 'Mysterious stories and intriguing conspiracies that keep you guessing.',
                'color' => 'info',
            ],
            [
                'title' => 'Inner Reflections',
                'slug' => Str::slug('Inner Reflections'),
                'content' => '<h2>Inner Reflections</h2><p>Delve into mental health, self-improvement, and understanding emotions for a better life. Find peace and growth within yourself.</p>',
                'meta_description' => 'Insights on mental health, self-improvement, and emotional well-being.',
                'color' => 'warning',
            ],
            [
                'title' => 'History and Culture',
                'slug' => Str::slug('History and Culture'),
                'content' => '<h2>History and Culture</h2><p>Uncover historical tales, cultural origins, and timeless traditions from around the world. Learn from the past to understand the present.</p>',
                'meta_description' => 'Explore fascinating stories of history and culture from around the globe.',
                'color' => 'danger',
            ],
            [
                'title' => 'Horror and Supernatural',
                'slug' => Str::slug('Horror and Supernatural'),
                'content' => '<h2>Horror and Supernatural</h2><p>Experience ghost stories, urban legends, and supernatural encounters. Brace yourself for spine-chilling tales.</p>',
                'meta_description' => 'Ghost stories, urban legends, and supernatural encounters that will send shivers down your spine.',
                'color' => 'dark',
            ],
            [
                'title' => 'Technology and Innovation',
                'slug' => Str::slug('Technology and Innovation'),
                'content' => '<h2>Technology and Innovation</h2><p>Explore the latest tech trends, digital innovation, and future possibilities. Stay ahead in the ever-evolving world of technology.</p>',
                'meta_description' => 'Discover the latest in tech trends, digital innovation, and future possibilities.',
                'color' => 'info',
            ],
            [
                'title' => 'Adventure and Exploration',
                'slug' => Str::slug('Adventure and Exploration'),
                'content' => '<h2>Adventure and Exploration</h2><p>Embark on adventures, explore hidden gems, and experience thrilling journeys worldwide. Satisfy your wanderlust with captivating stories.</p>',
                'meta_description' => 'Travel stories and explorations that take you on thrilling adventures around the world.',
                'color' => 'success',
            ],
            [
                'title' => 'Fiction Stories',
                'slug' => Str::slug('Fiction Stories'),
                'content' => '<h2>Fiction Stories</h2><p>Immerse yourself in imaginative tales, gripping narratives, and creative fiction. Let your imagination run wild.</p>',
                'meta_description' => 'Imaginative tales and gripping fiction that transport you to another world.',
                'color' => 'primary',
            ],
            [
                'title' => 'Education and Insights',
                'slug' => Str::slug('Education and Insights'),
                'content' => '<h2>Education and Insights</h2><p>Gain educational insights, practical tips, and informative guides for personal growth. Empower yourself with knowledge.</p>',
                'meta_description' => 'Educational articles, practical tips, and guides for personal and professional growth.',
                'color' => 'warning',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $templates = [
            [
                'question' => 'Kalau {name} jadi meme, captionnya bakal:',
                'options' => json_encode([
                    ['text' => '"When you remember cringe moment 3 tahun lalu"', 'is_image' => false],
                    ['text' => '"Muka pas liat mantan bahagia"', 'is_image' => false],
                    ['text' => '"Nongkrong vs Akhir bulan"', 'is_image' => false],
                    ['text' => '"When you realize it\'s Monday tomorrow"', 'is_image' => false]
                ]),
            ],
            [
                'question' => 'Aplikasi yang paling sering di-stalk {name}:',
                'options' => json_encode([
                    ['text' => 'Instagram', 'is_image' => false],
                    ['text' => 'TikTok', 'is_image' => false],
                    ['text' => 'Spotify Wrapped', 'is_image' => false],
                    ['text' => 'Shopee (riwayat belanja lebih seru!)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Kalau jadi karakter Squid Game, {name} bakal mati di game:',
                'options' => json_encode([
                    ['text' => 'Red Light Green Light (karena gemeteran)', 'is_image' => false],
                    ['text' => 'Dalgan (kaki pendek)', 'is_image' => false],
                    ['text' => 'Marble (terlalu mudah percaya)', 'is_image' => false],
                    ['text' => 'Tug of War (badan lemes kena mental issue)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan jika ketahuan gebetan di depan?',
                'options' => json_encode([
                    ['text' => 'Pura-pura buka tas padahal kosong', 'is_image' => false],
                    ['text' => 'Nyelip di balik pohon terdekat', 'is_image' => false],
                    ['text' => 'Langgar protokol jaga jarak', 'is_image' => false],
                    ['text' => 'Teriak "DARE INI BUKAN AKU!"', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Emoji yang paling mewakili kepribadian {name}:',
                'options' => json_encode([
                    ['text' => '🤡 - Tukang ngibul', 'is_image' => false],
                    ['text' => '👻 - Suka ghosting', 'is_image' => false],
                    ['text' => '💅 - Drama queen', 'is_image' => false],
                    ['text' => '🍵 - Tukang gosip', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa kebiasaan {name} yang bikin circle sebel?',
                'options' => json_encode([
                    ['text' => 'Baca chat seenak jidat', 'is_image' => false],
                    ['text' => 'Tukang pinjam charger', 'is_image' => false],
                    ['text' => 'Nyetel TikTok volume max', 'is_image' => false],
                    ['text' => 'Sering cancel plan last minute', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Kalau jadi item di Among Us, {name} adalah:',
                'options' => json_encode([
                    ['text' => 'Vent - Suka kabur dari masalah', 'is_image' => false],
                    ['text' => 'Kamera - Tukang kepo', 'is_image' => false],
                    ['text' => 'Emergency Button - Panikan', 'is_image' => false],
                    ['text' => 'Impostor - Tukang tipu', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa rahasia {name} yang belum pernah dibongkar?',
                'options' => json_encode([
                    ['text' => 'Pernah nembak 5 orang dalam 1 hari', 'is_image' => false],
                    ['text' => 'Masih simpan chat mantan 2018', 'is_image' => false],
                    ['text' => 'Akun fandom K-Pop samaran', 'is_image' => false],
                    ['text' => 'Sering stalk ex gebetan doi', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Kalau jadi Netflix show, judul hidup {name} adalah:',
                'options' => json_encode([
                    ['text' => '"The Chaos Theory of My DMs"', 'is_image' => false],
                    ['text' => '"Stranger Things in My Bank Account"', 'is_image' => false],
                    ['text' => '"Money Heist: Empty Wallet Edition"', 'is_image' => false],
                    ['text' => '"Squid Game: Tunjukin Receh Edition"', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan saat WiFi mati 24 jam?',
                'options' => json_encode([
                    ['text' => 'Nangis sambil pelamin bet', 'is_image' => false],
                    ['text' => 'Bikin puisi cringe di Notes', 'is_image' => false],
                    ['text' => 'Stalk tetangga pakai teropong', 'is_image' => false],
                    ['text' => 'Tidur 18 jam kayak koala', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa superpower {name} yang sebenarnya?',
                'options' => json_encode([
                    ['text' => 'Bisa tidur 16 jam nonstop', 'is_image' => false],
                    ['text' => 'Makan 3 porsi tanpa kenyang', 'is_image' => false],
                    ['text' => 'Deteksi gosip 10km radius', 'is_image' => false],
                    ['text' => 'Hilang saat ada yang nawarin tugas', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika jadi filter Instagram, {name} akan punya filter:',
                'options' => json_encode([
                    ['text' => 'Wajah glowing tanpa skincare', 'is_image' => false],
                    ['text' => 'Background aesthetic ala-ala Korea', 'is_image' => false],
                    ['text' => 'Efek mata jadi kayak anime', 'is_image' => false],
                    ['text' => 'Tulisan "Single Since 2003"', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan jika jadi invisible 1 hari?',
                'options' => json_encode([
                    ['text' => 'Naruh pisang di depan musuh', 'is_image' => false],
                    ['text' => 'Baca chat grup gaji tertinggi', 'is_image' => false],
                    ['text' => 'Rekam semua rahasia temen', 'is_image' => false],
                    ['text' => 'Bikin hantu di rumah gebetan', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa reaksi {name} saat liat mantan di IG Story?',
                'options' => json_encode([
                    ['text' => 'Screenshoot & kirim ke grup', 'is_image' => false],
                    ['text' => 'Lihat 10x biar nggak ketahuan', 'is_image' => false],
                    ['text' => 'Post story lebih wah biar saingan', 'is_image' => false],
                    ['text' => 'Ghosting 3 hari buat healing', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika besok kiamat, apa hal pertama yang {name} lakukan?',
                'options' => json_encode([
                    ['text' => 'Hapus history pencarian', 'is_image' => false],
                    ['text' => 'Confess ke crush via TikTok duet', 'is_image' => false],
                    ['text' => 'Makan semua stok indomie', 'is_image' => false],
                    ['text' => 'Bikin status "Goodbye toxic people"', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang akan {name} lakukan jika ACCIDENTALLY like post mantan dari 76 minggu lalu?',
                'options' => json_encode([
                    ['text' => 'Unfollow semua teman biar keliatan error', 'is_image' => false],
                    ['text' => 'Bikin story \'Ig ku kena hack!!!\'', 'is_image' => false],
                    ['text' => 'Double tap sampe 100x biar keliatan sengaja', 'is_image' => false],
                    ['text' => 'Bikin story "Ig ku kena hack!!!"', 'is_image' => false]
                ]),
            ],
            [
                'question' => 'Jika jadi karakter di Drakor, peran {name} pasti:',
                'options' => json_encode([
                    ['text' => 'Second lead yang nangis tiap episode', 'is_image' => false],
                    ['text' => 'Villain tukang nyebar gosip', 'is_image' => false],
                    ['text' => 'CEO muda tapi hutang 5M', 'is_image' => false],
                    ['text' => 'Extra yang cuma muncul waktu makan ramen', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa reaksi {name} saat tau crush-nya suka baca Shounen Ai?',
                'options' => json_encode([
                    ['text' => '\'Kita bisa jadi MC-nya...\' sambil kedip-kedip', 'is_image' => false],
                    ['text' => 'Blokir, takut ketularan gay panic', 'is_image' => false],
                    ['text' => 'Beli 10 novel BL buat \'hadiah ulang tahun\'', 'is_image' => false],
                    ['text' => 'Bikin akun samaran jadi fujoshi', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Aplikasi penghancur mental health {name} adalah:',
                'options' => json_encode([
                    ['text' => 'Twitter (bacot cancel culture)', 'is_image' => false],
                    ['text' => 'Tinder (dihubungi cuma scammer)', 'is_image' => false],
                    ['text' => 'ShopeePay (liat riwayat belanja bikin PTSD)', 'is_image' => false],
                    ['text' => 'LinkedIn (lulusan 2007 jadi CEO)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika terdampar di pulau, siapa yang akan {name} bawa?',
                'options' => json_encode([
                    ['text' => 'Ex yang jago masak (tapi mental breakdown tiap jam)', 'is_image' => false],
                    ['text' => 'Teman yang bisanya cuma bikin TikTok dance', 'is_image' => false],
                    ['text' => 'ChatGPT (biar ada yang diajak diskusi)', 'is_image' => false],
                    ['text' => 'Powerbank 100.000mAh (prioritas!)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa kebohongan terbesar {name} di CV?',
                'options' => json_encode([
                    ['text' => '\'Bisa Excel\' (padahal cuma bisa bold text)', 'is_image' => false],
                    ['text' => '\'Jago public speaking\' (gugup di depan kucing)', 'is_image' => false],
                    ['text' => '\'B2 level English\' (modal translate caption IG)', 'is_image' => false],
                    ['text' => '\'Sanggup kerja overtime\' (pulang jam 5.01)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika jadi meme, suara {name} di TikTok bakal pakai sound:',
                'options' => json_encode([
                    ['text' => 'Oh no... oh no no no no', 'is_image' => false],
                    ['text' => 'Bapak bapak, saya mau dilaporkin', 'is_image' => false],
                    ['text' => 'It\'s the ciiircle of liiife (versi fals)', 'is_image' => false],
                    ['text' => 'In this economy??', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan jika masuk grup WA \'Family\'?',
                'options' => json_encode([
                    ['text' => 'Mute seumur hidup', 'is_image' => false],
                    ['text' => 'Kirim sticker \'Good morning\' tiap jam 5 pagi', 'is_image' => false],
                    ['text' => 'Share link investasi bodong biar di-kick', 'is_image' => false],
                    ['text' => 'Ganti nama jadi \'Budi Pekerti\'', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa skandal terbesar {name} di masa sekolah?',
                'options' => json_encode([
                    ['text' => 'Nyontek pake kode morse', 'is_image' => false],
                    ['text' => 'Prank guru pakai suara kentut di Zoom', 'is_image' => false],
                    ['text' => 'Jual jawaban UN tapi salah semua', 'is_image' => false],
                    ['text' => 'Dikirimin bunga sama emak-emak kantin', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika harus pilih, {name} akan jual organ apa buat beli iPhone 16?',
                'options' => json_encode([
                    ['text' => 'Ginjal (kanan aja, kiri buat jaga-jaga)', 'is_image' => false],
                    ['text' => 'Kornea (bisa pake filter IG)', 'is_image' => false],
                    ['text' => 'Hati (soalnya udah hancur)', 'is_image' => false],
                    ['text' => 'Tulang rusuk (biar kurus aesthetic)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan kalau ketauan nembak 3 orang sekaligus?',
                'options' => json_encode([
                    ['text' => 'Bilang \'Ini riset buat skripsi\'', 'is_image' => false],
                    ['text' => 'Buat grup chat \'Haremku\'', 'is_image' => false],
                    ['text' => 'Kabur ke Mars pake roket Elon', 'is_image' => false],
                    ['text' => 'Post TikTok dance biar viral', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa phobia paling aneh {name}?',
                'options' => json_encode([
                    ['text' => 'Takut sama notifikasi \'online\' di WA', 'is_image' => false],
                    ['text' => 'Gemetar kalo liat notif email', 'is_image' => false],
                    ['text' => 'Panik saat denger suara \'izin tagih?\'', 'is_image' => false],
                    ['text' => 'Alergi sama chat voice 59 detik', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika jadi makanan, {name} adalah...',
                'options' => json_encode([
                    ['text' => 'Indomie (terlihat murah tapi dicintai)', 'is_image' => false],
                    ['text' => 'Brokoli (sehat tapi dibenci)', 'is_image' => false],
                    ['text' => 'Sambal (dihindarin mantan)', 'is_image' => false],
                    ['text' => 'Nasi kotak (selalu ada di drama)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa alasan {name} cancel kencan?',
                'options' => json_encode([
                    ['text' => '\'Aku kena COVID... hati\'', 'is_image' => false],
                    ['text' => 'Lagi cosplay jadi hermit crab', 'is_image' => false],
                    ['text' => 'Harus nemenin kucing PMS', 'is_image' => false],
                    ['text' => 'Mimpi buruk gebetan punya telinga', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} cari di Google saat gabut?',
                'options' => json_encode([
                    ['text' => 'Cara kaya dalam 1 hari tanpa kerja', 'is_image' => false],
                    ['text' => 'Apakah alien punya OnlyFans?', 'is_image' => false],
                    ['text' => 'Kenapa doi baca chat tapi nggak balas', 'is_image' => false],
                    ['text' => 'Gaji UGD Jakarta vs gaji aku', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika hidup {name} adalah playlist, judulnya:',
                'options' => json_encode([
                    ['text' => '\'Lagu Sedih untuk Hati yang Lapar\'', 'is_image' => false],
                    ['text' => '\'TikTok Hits I Follow to Look Cool\'', 'is_image' => false],
                    ['text' => '\'Nostalgia Cinta Segitiga 2019\'', 'is_image' => false],
                    ['text' => '\'Musik Sambil Nangis Lihat Dompet\'', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan kalau tiba-tiba kaya?',
                'options' => json_encode([
                    ['text' => 'Beli verified mark di IG', 'is_image' => false],
                    ['text' => 'Sewa artis K-pop buat jadi pacar bayaran', 'is_image' => false],
                    ['text' => 'Bikin sekolah \'Anti Ghosting 101\'', 'is_image' => false],
                    ['text' => 'Ngebom inbox mantan pakai transfer Gopay', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa reaksi {name} saat dimintai nomor sama ojol?',
                'options' => json_encode([
                    ['text' => 'Kasih nomor musuh bebuyutan', 'is_image' => false],
                    ['text' => 'Bilang \'Aku sudah punya pacar... imajiner\'', 'is_image' => false],
                    ['text' => 'Langgar lampu merah biar kabur', 'is_image' => false],
                    ['text' => 'Live TikTok sambil teriak \'Aku viral!!!\'', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika jadi konten TikTok, video {name} yang paling banyak di-save pasti:',
                'options' => json_encode([
                    ['text' => '\'Cara ghosting tanpa merasa bersalah\'', 'is_image' => false],
                    ['text' => '\'ASMR makan mi sambil nangis\'', 'is_image' => false],
                    ['text' => '\'Tutorial akting kaya biar dikirimin uang\'', 'is_image' => false],
                    ['text' => '[Foto screenshot chat \'kita temenan aja ya\']', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Kalau {name} jadi meme TikTok, bunyi \'Oh no\' versi mereka tentang:',
                'options' => json_encode([
                    ['text' => 'Pas mau bilang \'I love you\' malah keluar \'I loaf you\'', 'is_image' => false],
                    ['text' => 'Lagi meeting Zoom tapi filter kucing nyala', 'is_image' => false],
                    ['text' => 'Ngetag mantan di post ultah gebetan', 'is_image' => false],
                    ['text' => 'Bunyi: "Oh no... pas ketahuan nge-stalk crush"', 'is_image' => false]
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan saat tahu crush-nya punya OnlyFans?',
                'options' => json_encode([
                    ['text' => 'Subscribe pake duit jatah jajan 3 bulan', 'is_image' => false],
                    ['text' => 'Report akun sambil nangis di grup WA', 'is_image' => false],
                    ['text' => 'Bilang \'Aku cuma mau support karirmu\'', 'is_image' => false],
                    ['text' => 'Bikin fanpage samaran buat request custom content', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika hidup {name} adalah Google review, bintang berapa?',
                'options' => json_encode([
                    ['text' => '⭐ (Keterangan: \'Baterai cepat lowbat, sering error\')', 'is_image' => false],
                    ['text' => '⭐⭐⭐ (Review: \'Cocok buat yang suka plot twist toxic\')', 'is_image' => false],
                    ['text' => '⭐⭐⭐⭐⭐ (Catatan: \'Bisa return tanpa receipt\')', 'is_image' => false],
                    ['text' => '0 bintang (Review: "Would not recommend")', 'is_image' => false]
                ]),
            ],
            [
                'question' => 'Apa yang akan {name} jual di black market?',
                'options' => json_encode([
                    ['text' => 'SS chat gebetan yang udah di-crop', 'is_image' => false],
                    ['text' => 'Kepingan hati bekas ditolak 7x', 'is_image' => false],
                    ['text' => 'Air mata waktu nonton Drakor', 'is_image' => false],
                    ['text' => 'Akun Twitter fandom BTS tahun 2016', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa status WA {name} kalau kiamat zombie terjadi?',
                'options' => json_encode([
                    ['text' => '\'Butuh zombie buat makan mantan\'', 'is_image' => false],
                    ['text' => '\'Yang mau collab survive, DM! Prioritas cakep\'', 'is_image' => false],
                    ['text' => '\'Jual senjata api (bohong, cuma sendok)\'', 'is_image' => false],
                    ['text' => 'Status: "Butuh zombie buat makan mantan"', 'is_image' => false]
                ]),
            ],
            [
                'question' => 'Kalau jadi karakter Mobile Legends, skill ulti {name} akan mirip dengan ulti-nya:',
                'options' => json_encode([
                    ['text' => 'Miya (suka kabur dari masalah)', 'is_image' => false],
                    ['text' => 'Vexana (nge-summon kenalan yang punya power)', 'is_image' => false],
                    ['text' => 'Freya (tantrum lompat-lompat gak jelas)', 'is_image' => false],
                    ['text' => 'Tigreal (bikin ngumpulin semua orang ke satu tempat)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Hero favorit {name} di Mobile Legends pasti:',
                'options' => json_encode([
                    ['text' => 'Layla (karena nggak perlu mikir, tinggal tembak)', 'is_image' => false],
                    ['text' => 'Franco (suka hook, tapi sering miss)', 'is_image' => false],
                    ['text' => 'Gusion (biar keliatan pro, padahal sering mati)', 'is_image' => false],
                    ['text' => 'Johnson (suka nyetir tapi nabrak tembok)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan saat kalah di Mobile Legends?',
                'options' => json_encode([
                    ['text' => 'Nyalahin jungler karena retri indomaret mulu', 'is_image' => false],
                    ['text' => 'Bikin status WA "Jangan ajak ML, lagi sial"', 'is_image' => false],
                    ['text' => 'Uninstall aplikasi, tapi besok install lagi', 'is_image' => false],
                    ['text' => 'Nonton tutorial pro player biar bisa nyalahin temen', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa alasan {name} telat bayar kosan?',
                'options' => json_encode([
                    ['text' => 'Duitnya buat beli tiket konser Coldplay', 'is_image' => false],
                    ['text' => 'Kena tipu investasi \'Ayam Petelur NFT\'', 'is_image' => false],
                    ['text' => 'Bayarin gebetan makan sushi 5x sehari', 'is_image' => false],
                    ['text' => 'Tertipu giveaway \'iPhone 15 gratis\'', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika ada di episode Satu Persen, judul episode {name}:',
                'options' => json_encode([
                    ['text' => '\'Cara Move On Dalam 3 Tahun (Gagal)\'', 'is_image' => false],
                    ['text' => '\'Mengapa Mantanmu Lebih Bahagia?\'', 'is_image' => false],
                    ['text' => '\'Skandal LinkedIn: Fake It Till You Make It\'', 'is_image' => false],
                    ['text' => '[Foto thumbnail clickbait \'AKU HAMIL?!]', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan jika ketahuan nge-stalk crush 18 jam sehari?',
                'options' => json_encode([
                    ['text' => 'Bikin akun fanpage pujian anonim', 'is_image' => false],
                    ['text' => 'Klaim \'Aku cuma riset buat skripsi\'', 'is_image' => false],
                    ['text' => 'Balik stalk stalkernya biar fair', 'is_image' => false],
                    ['text' => 'Post TikTok tutorial cyberstalking', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Kalau jadi menu McD, {name} adalah:',
                'options' => json_encode([
                    ['text' => 'Ayam geprek (laku tapi bikin mules)', 'is_image' => false],
                    ['text' => 'Blackpink meal (aesthetic tapi mahal)', 'is_image' => false],
                    ['text' => 'Es krim rusak mesin (sedih terus)', 'is_image' => false],
                    ['text' => 'Nasi uduk 4AM (buat yang begadang galau)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} screenshot tanpa izin?',
                'options' => json_encode([
                    ['text' => 'Chat malam minggu gebetan sama orang', 'is_image' => false],
                    ['text' => 'Postingan gaji temen di LinkedIn', 'is_image' => false],
                    ['text' => 'Story mantan yang lagi di Paris', 'is_image' => false],
                    ['text' => '[SS lirik lagu galau di Spotify]', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika jadi bencana alam, {name} adalah:',
                'options' => json_encode([
                    ['text' => 'Tsunami (bawa masalah bertubi-tubi)', 'is_image' => false],
                    ['text' => 'Gempa (bikin semua goyah)', 'is_image' => false],
                    ['text' => 'Kabut asap (bikin sesak tapi invisible)', 'is_image' => false],
                    ['text' => 'Puting beliung (chaos di satu titik)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa isi notes rahasia {name} di hp?',
                'options' => json_encode([
                    ['text' => 'Daftar mantan + alasan putus (versi mereka)', 'is_image' => false],
                    ['text' => 'Skrip ghosting untuk tipe zodiac berbeda', 'is_image' => false],
                    ['text' => 'Kalkulator hutang teman-teman', 'is_image' => false],
                    ['text' => 'Puisi cinta pakai bahasa Klingon', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa reaksi {name} kalo dikasih ultimatum \'Aku atau Taylor Swift\'?',
                'options' => json_encode([
                    ['text' => '\'Kamu yang Swift kan?\' block', 'is_image' => false],
                    ['text' => 'Beli tiket konser buat berdua', 'is_image' => false],
                    ['text' => 'Bikin duet TikTok versi \'Love Story\'', 'is_image' => false],
                    ['text' => '[Foto meme \'We Are Never Ever Getting Back Together\']', 'is_image' => true],
                ]),
            ],
            [
                'question' => 'Kalau jadi bencong di sinetron, peran {name} adalah:',
                'options' => json_encode([
                    ['text' => 'Tukang nyebar gosip kosan', 'is_image' => false],
                    ['text' => 'Asisten dosen yang sok imut', 'is_image' => false],
                    ['text' => 'Penjual skincare abal-abal', 'is_image' => false],
                    ['text' => 'Pembawa acara lamaran gagal', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} upload di Instagram alts?',
                'options' => json_encode([
                    ['text' => 'Foto aesthetic ala-ala k-popers', 'is_image' => false],
                    ['text' => 'Thread gosip seleb TikTok', 'is_image' => false],
                    ['text' => 'Potret eksperimen masak Indomie', 'is_image' => false],
                    ['text' => '[Foto close-up mata merah habis nangis]', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Apa yang {name} lakukan saat tahu gaji pertama cuma Rp 2,7 juta?',
                'options' => json_encode([
                    ['text' => 'Post IG Story \'Dream bigger\' sambil nangis', 'is_image' => false],
                    ['text' => 'Jual kaos \'Korban Kapitalisme\'', 'is_image' => false],
                    ['text' => 'Tag HRD di TikTok dance gaji UMR', 'is_image' => false],
                    ['text' => 'Pindah ke hutan jadi hermit (versi medsos)', 'is_image' => false],
                ]),
            ],
            [
                'question' => 'Jika jadi lagu TikTok, lirik yang mewakili {name} adalah:',
                'options' => json_encode([
                    ['text' => '\'Can\'t you see I\'m crineee?\' (sambil mukul bantal)', 'is_image' => false],
                    ['text' => '\'Aku mau kamu, tapi kamu mau diaaaaa\'', 'is_image' => false],
                    ['text' => '\'Mentok di friendzone, mentok di zonk\'', 'is_image' => false],
                    ['text' => '\'Ku ingin, kau jadi milikku\'', 'is_image' => false],
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
                'approved_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Article::insert($articles);
    }
}

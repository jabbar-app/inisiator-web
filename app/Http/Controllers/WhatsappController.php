<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function sendNotification($articleId, $adminNumber = '08990980799')
    {
        // Misal ambil data artikel
        $article = Article::findOrFail($articleId);

        // Token Fonnte
        $token = 'p56gF9W4WQZLgs9qq1sY';

        // Buat link approval (sesuaikan route)
        // Contoh route: articles.approve -> /articles/{id}/approve
        $approveUrl = route('articles.approve', $article->id);

        // Siapkan data
        // 'target' => bisa multiple (dipisah koma). Di sini satu nomor
        // 'message' => isi pesan. Contoh menambahkan judul artikel dan link approval.
        // Boleh memakai placeholder {name} dsb. tapi di sini kita pakai teks biasa.
        $postFields = [
            'target'   => $adminNumber,
            'message'  => "Halo Admin, ada artikel baru dengan judul '{$article->title}'.\nSilakan review di: {$approveUrl}",
            'delay'    => '1-3', // random 1-3 detik
            'countryCode' => '62',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_HTTPHEADER     => [
                "Authorization: $token",
            ],
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            // Bisa log error atau menampilkan flash message
            return "Error: $error_msg";
        }

        return $response; // Atau redirect / flash message
    }
}

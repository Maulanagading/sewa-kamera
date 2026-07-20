<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function ask(Request $request)
    {
        $pertanyaanUser = $request->input("pertanyaan");

        // Ambil daftar barang dari database yang sedang tersedia (menggunakan tabel 'products' milik Anda)
        $barangTersedia = \Illuminate\Support\Facades\DB::table('products')->where('stock', '>', 0)->get(['name', 'category', 'price']);
        
        $daftarBarangText = "DAFTAR INVENTARIS TOKO KAMI:\n";
        foreach ($barangTersedia as $barang) {
            $daftarBarangText .= "- " . $barang->name . " (Kategori: " . $barang->category . ", Harga: Rp " . number_format($barang->price, 0, ',', '.') . "/hari)\n";
        }

        // API Key langsung (jangan pakai env jika format string)
        $apiKey = "AQ.Ab8RN6Ld-o6XqY04e4PVPR5KQgl-27QHtO_hVknQGsYuHhzO9w";

        $prompt = "kamu adalah asisten ahli fotografi yang bekerja di tempat penyewaan 'Gading Rental Kamera'. Jawab pertanyaan pelanggan dengan ramah, informatif, dan ringkas. \nPENTING 1: Jawab menggunakan teks biasa, JANGAN gunakan format markdown seperti bintang-bintang tebal (**), dan JANGAN PERNAH menggunakan emoji sama sekali agar terlihat rapi dan profesional. \nPENTING 2: JIKA pelanggan minta rekomendasi barang, KAMU HANYA BOLEH MEREKOMENDASIKAN BARANG YANG ADA DI DAFTAR INVENTARIS TOKO KAMI BERIKUT INI. Jangan sebutkan barang yang tidak ada di toko. \n\n" . $daftarBarangText . "\n\nPertanyaan pelanggan: " . $pertanyaanUser;

        try {
            // Kita tambah batas waktu tunggu menjadi 60 detik.
            // Kadang kala otak AI Google butuh waktu lebih dari 15 detik untuk merangkai jawaban fotografi.
            $response = Http::withoutVerifying()
                ->withOptions([
                    'curl' => [
                        CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
                    ]
                ])
                ->timeout(60)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ]
                ]);

            if ($response->successful()) {
                $balasan = $response->json()['candidates'][0]['content']['parts'][0]['text'];

                return response()->json([
                    'status' => 'success',
                    'jawaban' => $balasan
                ]);
            }

            // AMBIL PESAN ERROR ASLI DARI GOOGLE
            $googleError = $response->json();
            $pesanError = isset($googleError['error']['message']) ? $googleError['error']['message'] : 'Gagal tanpa alasan jelas dari Google';

            return response()->json([
                'status' => 'error',
                'jawaban' => 'Google menolak request: ' . $pesanError
            ]);
        } catch (\Exception $e) {
            // Jika macet (misal tidak ada internet / SSL error), akan tertangkap di sini
            return response()->json([
                'status' => 'error',
                'jawaban' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}

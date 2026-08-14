<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Faq;
use App\Models\Layanan;
use App\Models\Pengaturan;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ────────────────────────────────────────
        // Gunakan DB::table langsung untuk menghindari double-hash
        // (Model User menggunakan cast 'hashed' pada kolom password)
        DB::table('users')->insert([
            'id'         => Str::uuid(),
            'nama'       => 'Administrator',
            'email'      => 'admin@usg4d.com',
            'password'   => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ── Pengaturan (Single Record) ─────────────────────────
        Pengaturan::create([
            'nama_situs'      => 'Klinik USG 4D',
            'slogan'          => 'Lihat Keajaiban Buah Hati Anda dengan Teknologi Terkini',
            'deskripsi_situs' => 'Klinik USG 4D terpercaya dengan teknologi terkini untuk melihat perkembangan janin secara jelas dan detail.',
            'nama_perusahaan' => 'Klinik USG 4D',
            'alamat'          => 'Jl. Kesehatan No. 1, Kota Sehat, Indonesia',
            'kode_pos'        => '12345',
            'telepon'         => '021-1234567',
            'whatsapp'        => '6281234567890',
            'email'           => 'info@usg4d.com',
            'jam_operasional' => [
                ['hari' => 'Senin – Jumat', 'jam' => '08:00 – 20:00'],
                ['hari' => 'Sabtu',         'jam' => '08:00 – 17:00'],
                ['hari' => 'Minggu & Libur','jam' => '09:00 – 14:00'],
            ],
            'media_sosial' => [
                'facebook'  => 'https://facebook.com/usg4d',
                'instagram' => 'https://instagram.com/usg4d',
                'youtube'   => '',
                'tiktok'    => '',
            ],
            'meta_seo' => [
                'keywords' => 'USG 4D, klinik USG, USG kehamilan, USG janin, 4D ultrasound',
                'author'   => 'Klinik USG 4D',
                'google_analytics' => '',
            ],
        ]);

        // ── Layanan ───────────────────────────────────────────
        $layanans = [
            ['judul' => 'USG 4D Premium',       'deskripsi' => 'Paket USG 4D terlengkap dengan kualitas gambar HD. Dapatkan foto dan video kenangan indah bersama buah hati Anda dalam paket premium kami.',        'urutan' => 1],
            ['judul' => 'USG 4D Reguler',       'deskripsi' => 'Paket USG 4D standar dengan kualitas gambar jernih. Ideal untuk pemeriksaan rutin dan kenangan bersama keluarga.',                                     'urutan' => 2],
            ['judul' => 'USG 2D Obstetri',      'deskripsi' => 'Pemeriksaan USG 2D untuk monitoring kehamilan, mengetahui posisi bayi, berat badan janin, dan kondisi plasenta secara akurat.',                       'urutan' => 3],
            ['judul' => 'USG Doppler',           'deskripsi' => 'Pemeriksaan aliran darah plasenta dan tali pusat menggunakan teknologi Doppler untuk memastikan sirkulasi darah janin dalam kondisi optimal.',        'urutan' => 4],
            ['judul' => 'Paket Dokumentasi HD',  'deskripsi' => 'Dapatkan foto resolusi tinggi dan video kenangan perjalanan kehamilan Anda. File digital siap cetak dalam kualitas terbaik.',                         'urutan' => 5],
            ['judul' => 'Konsultasi Kehamilan',  'deskripsi' => 'Konsultasi langsung dengan dokter spesialis kandungan berpengalaman untuk menjawab semua pertanyaan seputar kehamilan dan perkembangan janin Anda.',  'urutan' => 6],
        ];

        foreach ($layanans as $l) {
            Layanan::create(array_merge($l, ['aktif' => true]));
        }

        // ── FAQ ───────────────────────────────────────────────
        $faqs = [
            ['pertanyaan' => 'Kapan waktu terbaik untuk USG 4D?',                'jawaban' => 'Waktu terbaik untuk melakukan USG 4D adalah antara usia kehamilan 26–32 minggu. Pada periode ini, bayi sudah memiliki lapisan lemak yang cukup sehingga gambar wajah terlihat lebih jelas dan detail.',                                                            'urutan' => 1],
            ['pertanyaan' => 'Apakah USG 4D aman untuk ibu dan janin?',          'jawaban' => 'Ya, USG 4D menggunakan gelombang suara (bukan radiasi) sehingga sepenuhnya aman bagi ibu dan janin. Prosedur ini telah disetujui oleh berbagai organisasi kesehatan dunia termasuk WHO dan BPOM.',                                                                   'urutan' => 2],
            ['pertanyaan' => 'Berapa lama durasi pemeriksaan USG 4D?',           'jawaban' => 'Durasi pemeriksaan USG 4D biasanya berkisar antara 20–45 menit, tergantung posisi bayi dan paket yang dipilih. Pada paket premium, waktu bisa lebih lama karena mencakup sesi foto dan perekaman video.',                                                           'urutan' => 3],
            ['pertanyaan' => 'Apakah perlu persiapan khusus sebelum USG 4D?',   'jawaban' => 'Disarankan untuk mengonsumsi makanan manis atau minuman bersoda 30 menit sebelum pemeriksaan agar bayi lebih aktif bergerak. Selain itu, pastikan kandung kemih tidak terlalu penuh atau kosong.',                                                                    'urutan' => 4],
            ['pertanyaan' => 'Bisakah saya mengajak keluarga saat pemeriksaan?', 'jawaban' => 'Tentu saja! Kami sangat menyambut kehadiran keluarga, terutama pasangan, ayah, dan kakek-nenek. Momen ini adalah pengalaman berharga yang bisa dinikmati bersama. Ruang pemeriksaan kami dirancang nyaman untuk keluarga.',                                          'urutan' => 5],
            ['pertanyaan' => 'Apakah hasil USG bisa dilihat secara langsung?',   'jawaban' => 'Ya! Anda dapat melihat gambar dan video bayi secara langsung di layar monitor besar selama pemeriksaan berlangsung. Hasil foto dan video akan diberikan dalam format digital yang siap dibagikan ke media sosial.',                                                    'urutan' => 6],
        ];

        foreach ($faqs as $f) {
            Faq::create(array_merge($f, ['aktif' => true]));
        }

        // ── Testimoni ─────────────────────────────────────────
        $testimonis = [
            ['nama' => 'Ibu Sari Dewi',     'jabatan' => 'Ibu Rumah Tangga',     'perusahaan' => '',                       'ulasan' => 'Pengalaman USG 4D di sini luar biasa! Gambar bayi saya sangat jelas dan detail. Dokter dan stafnya sangat ramah dan profesional. Sangat direkomendasikan!',      'penilaian' => 5, 'urutan' => 1],
            ['nama' => 'Bapak Ahmad Rizki',  'jabatan' => 'Software Engineer',    'perusahaan' => 'Tech Startup',           'ulasan' => 'Pelayanan sangat memuaskan. Ruangan bersih dan nyaman. Hasil foto dan video berkualitas HD. Kami sangat senang bisa melihat ekspresi wajah bayi kami dengan jelas.', 'penilaian' => 5, 'urutan' => 2],
            ['nama' => 'Ibu Putri Maharani', 'jabatan' => 'Guru',                 'perusahaan' => 'SDN 01 Sukamaju',        'ulasan' => 'Staf yang sabar dan dokter yang sangat informatif. Semua pertanyaan saya dijawab dengan lengkap. Harga juga sangat terjangkau untuk kualitas sebagus ini.',          'penilaian' => 5, 'urutan' => 3],
            ['nama' => 'Ibu Rini Susanti',   'jabatan' => 'Pengusaha',            'perusahaan' => 'CV Makmur Jaya',         'ulasan' => 'Sudah dua kali ke sini dan selalu puas. Teknologi USG 4D-nya canggih, gambar sangat detail. Tempat parkir luas dan mudah dijangkau.',                               'penilaian' => 5, 'urutan' => 4],
            ['nama' => 'Bapak Deni Kurnia',  'jabatan' => 'Dokter Umum',          'perusahaan' => 'Puskesmas Sehat',        'ulasan' => 'Sebagai tenaga medis, saya terkesan dengan peralatan USG mereka yang sangat modern. Dokter spesialisnya kompeten dan selalu update dengan perkembangan ilmu terkini.','penilaian' => 5, 'urutan' => 5],
            ['nama' => 'Ibu Mega Wulandari', 'jabatan' => 'Karyawan Swasta',      'perusahaan' => 'PT Sejahtera Bersama',   'ulasan' => 'Pelayanan ramah dan profesional. Bayi saya terlihat sangat jelas, bisa melihat gerakannya secara realtime. Kenangan yang tidak akan terlupakan!',                    'penilaian' => 4, 'urutan' => 6],
        ];

        foreach ($testimonis as $t) {
            Testimoni::create(array_merge($t, ['aktif' => true]));
        }

        // ── Artikel ───────────────────────────────────────────
        $artikels = [
            [
                'judul'          => 'Panduan Lengkap USG 4D: Apa yang Perlu Anda Ketahui',
                'slug'           => 'panduan-lengkap-usg-4d',
                'deskripsi'      => 'Semua yang perlu Anda ketahui tentang USG 4D, mulai dari cara kerja, manfaat, hingga persiapan sebelum pemeriksaan.',
                'konten'         => '<h2>Apa itu USG 4D?</h2><p>USG 4D adalah teknologi ultrasonografi terkini yang memungkinkan Anda melihat gambar bayi dalam kandungan secara tiga dimensi dan bergerak secara real-time. Berbeda dengan USG 2D yang menghasilkan gambar datar, USG 4D memberikan tampilan yang jauh lebih detail dan lifelike.</p><h2>Manfaat USG 4D</h2><ul><li>Melihat ekspresi wajah bayi secara detail</li><li>Memantau gerakan dan aktivitas bayi</li><li>Mendeteksi kelainan struktural lebih awal</li><li>Menguatkan bonding antara orang tua dan bayi</li></ul>',
                'diterbitkan'    => true,
                'tanggal_terbit' => now()->subDays(7),
            ],
            [
                'judul'          => 'Tips Mempersiapkan Diri Sebelum USG 4D',
                'slug'           => 'tips-persiapan-usg-4d',
                'deskripsi'      => 'Ikuti tips berikut untuk mendapatkan hasil USG 4D terbaik dan pengalaman yang menyenangkan bersama keluarga.',
                'konten'         => '<h2>Persiapan Penting Sebelum USG 4D</h2><p>Mendapatkan gambar USG 4D yang jelas memerlukan beberapa persiapan. Berikut tips dari dokter kami:</p><h3>1. Minum Air yang Cukup</h3><p>Pastikan Anda terhidrasi dengan baik setidaknya 1-2 hari sebelum pemeriksaan. Kandung kemih yang terisi membantu mendapatkan gambar yang lebih jelas.</p><h3>2. Konsumsi Makanan Manis</h3><p>Minumlah jus atau minuman manis 30 menit sebelum pemeriksaan. Ini akan membuat bayi lebih aktif bergerak sehingga lebih mudah mendapatkan foto terbaik.</p>',
                'diterbitkan'    => true,
                'tanggal_terbit' => now()->subDays(3),
            ],
            [
                'judul'          => 'Perbedaan USG 2D, 3D, dan 4D yang Harus Anda Tahu',
                'slug'           => 'perbedaan-usg-2d-3d-4d',
                'deskripsi'      => 'Bingung memilih jenis USG? Simak perbedaan lengkap antara USG 2D, 3D, dan 4D untuk membantu Anda membuat keputusan terbaik.',
                'konten'         => '<h2>Mengenal Perbedaan Jenis USG</h2><p>Setiap jenis USG memiliki keunggulan tersendiri. Mari kita bahas perbedaannya:</p><h3>USG 2D</h3><p>USG konvensional yang menghasilkan gambar hitam-putih datar. Sangat baik untuk pemeriksaan medis rutin, mengukur perkembangan janin, dan mendeteksi kelainan organ.</p><h3>USG 3D</h3><p>Menghasilkan gambar tiga dimensi statis (tidak bergerak). Gambar lebih detail dari 2D dan membantu melihat struktur wajah bayi dengan lebih baik.</p><h3>USG 4D</h3><p>Gambar 3D yang ditampilkan secara real-time sehingga Anda bisa melihat gerakan bayi. Ini adalah pengalaman paling menyentuh dan memorable bagi calon orang tua.</p>',
                'diterbitkan'    => true,
                'tanggal_terbit' => now()->subDay(),
            ],
        ];

        foreach ($artikels as $a) {
            Artikel::create($a);
        }
    }
}

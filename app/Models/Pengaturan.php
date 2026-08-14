<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasUuids;

    /**
     * Allow all fields to be mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'jam_operasional' => 'array',
            'media_sosial' => 'array',
            'meta_seo' => 'array',
            'misi' => 'array',
            'nilai_nilai' => 'array',
            'tim_klinik' => 'array',
        ];
    }

    /**
     * Get the singleton pengaturan record (creates one if it doesn't exist).
     */
    public static function getSetting(): static
    {
        return static::firstOrCreate([], [
            'nama_situs'     => 'Spa Kecantikan',
            'slogan'         => 'Rasakan Ketenangan & Kecantikan Alami',
            'gambar_hero'    => null,
            'nama_perusahaan'=> 'Spa Kecantikan',
            'media_sosial'   => [
                'facebook'  => '',
                'instagram' => '',
                'youtube'   => '',
                'tiktok'    => '',
            ],
            'meta_seo' => [
                'keywords' => 'spa, wellness, massage, facial, body treatment, relaksasi, kecantikan',
                'author'   => 'Spa Kecantikan',
                'google_analytics' => '',
            ],
            'jam_operasional' => [
                ['hari' => 'Senin – Jumat', 'jam' => '09:00 – 21:00'],
                ['hari' => 'Sabtu',         'jam' => '09:00 – 22:00'],
                ['hari' => 'Minggu',        'jam' => '10:00 – 20:00'],
            ],
            'visi' => 'Menjadi spa & wellness terdepan dan terpercaya di Indonesia, memberikan pengalaman relaksasi dan kecantikan terbaik bagi setiap pelanggan.',
            'misi' => [
                ['teks' => 'Menyediakan layanan spa & wellness berkualitas tinggi dengan produk alami premium'],
                ['teks' => 'Memberikan pelayanan yang nyaman, ramah, dan profesional kepada setiap pelanggan'],
                ['teks' => 'Memastikan setiap treatment dilakukan oleh terapis bersertifikat dan berpengalaman'],
                ['teks' => 'Menciptakan suasana yang menenangkan untuk relaksasi tubuh dan pikiran'],
                ['teks' => 'Terus berinovasi dengan treatment terbaru untuk kesehatan dan kecantikan'],
            ],
            'nilai_nilai' => [
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                    'title' => 'Aman & Terpercaya',
                    'desc' => 'Menggunakan produk alami bersertifikat yang aman untuk semua jenis kulit dan telah teruji secara dermatologis.',
                    'color' => 'spa',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                    'title' => 'Produk Premium',
                    'desc' => 'Hanya menggunakan produk perawatan organik dan natural berkualitas tinggi dari brand terpercaya.',
                    'color' => 'sage',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
                    'title' => 'Terapis Profesional',
                    'desc' => 'Ditangani langsung oleh terapis bersertifikat dengan pengalaman bertahun-tahun di bidang spa & wellness.',
                    'color' => 'spa',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'title' => 'Pengalaman Mewah',
                    'desc' => 'Suasana spa yang mewah dan menenangkan, dirancang khusus untuk memberikan pengalaman relaksasi premium.',
                    'color' => 'sage',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'title' => 'Jadwal Fleksibel',
                    'desc' => 'Buka 7 hari seminggu dengan jam operasional yang luas untuk menyesuaikan waktu luang Anda.',
                    'color' => 'spa',
                ],
                [
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
                    'title' => 'Penuh Perhatian',
                    'desc' => 'Setiap pelanggan diperlakukan dengan penuh perhatian dan kasih sayang. Kepuasan Anda adalah prioritas utama kami.',
                    'color' => 'sage',
                ],
            ],
            'tim_klinik' => [],
        ]);
    }
}

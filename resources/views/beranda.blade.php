@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', $setting->deskripsi_situs ?? 'Spa & Wellness premium untuk relaksasi tubuh dan pikiran Anda. Nikmati pengalaman perawatan terbaik.')

@section('content')

{{-- ══════════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════════ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden {{ $setting->gambar_hero ? 'bg-cover bg-center' : 'hero-gradient bg-pattern' }}"
         @if($setting->gambar_hero) style="background-image: url('{{ Storage::url($setting->gambar_hero) }}');" @endif>
    
    @if($setting->gambar_hero)
    {{-- Overlay for background image so text remains readable --}}
    <div class="absolute inset-0 bg-cream-50/80 backdrop-blur-[2px]"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-cream-50/95 via-cream-50/80 to-transparent"></div>
    @endif

    {{-- Decorative blobs --}}
    <div class="absolute top-20 right-10 w-72 h-72 bg-spa-200/40 rounded-full blur-3xl pointer-events-none animate-pulse-slow"></div>
    <div class="absolute bottom-20 left-10 w-96 h-96 bg-sage-200/30 rounded-full blur-3xl pointer-events-none animate-float" style="animation-delay: 1s;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Hero Text --}}
            <div class="animate-on-scroll">
                <div class="section-badge">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    Premium Spa & Wellness
                </div>

                <h1 class="section-title mb-6">
                    Rasakan <span class="text-gradient dynamic-text transition-all duration-500 inline-block min-w-[200px]">Ketenangan</span><br>
                    & Kecantikan Alami
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-xl">
                    Manjakan tubuh dan pikiran Anda dengan perawatan spa premium. Terapis bersertifikat, produk berkualitas, dan suasana yang menenangkan untuk pengalaman relaksasi terbaik.
                </p>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment%20spa"
                       target="_blank" class="btn-primary" id="hero-booking-btn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Booking Sekarang
                    </a>
                    @endif
                    <a href="{{ route('layanan') }}" class="btn-secondary" id="hero-layanan-btn">
                        Lihat Menu Treatment
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex items-center gap-8 mt-10 pt-8 border-t border-spa-200/80">
                    <div>
                        <div class="text-2xl font-heading font-bold text-gray-800">5.000+</div>
                        <div class="text-sm text-gray-500">Pelanggan Puas</div>
                    </div>
                    <div class="w-px h-10 bg-spa-200"></div>
                    <div>
                        <div class="text-2xl font-heading font-bold text-gray-800">10+</div>
                        <div class="text-sm text-gray-500">Tahun Berpengalaman</div>
                    </div>
                    <div class="w-px h-10 bg-spa-200"></div>
                    <div>
                        <div class="text-2xl font-heading font-bold text-gray-800">4.9⭐</div>
                        <div class="text-sm text-gray-500">Rating Pelanggan</div>
                    </div>
                </div>
            </div>

            {{-- Hero Visual — Spa Illustration --}}
            <div class="animate-on-scroll delay-200 flex items-center justify-center">
                <div class="relative w-full max-w-lg mx-auto animate-float">
                    <svg viewBox="0 0 480 400" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto drop-shadow-2xl">
                        <defs>
                            <linearGradient id="heroGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#c4a882"/>
                                <stop offset="100%" style="stop-color:#8b6f47"/>
                            </linearGradient>
                            <linearGradient id="waterGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#d4e8dc"/>
                                <stop offset="100%" style="stop-color:#96a37e"/>
                            </linearGradient>
                            <linearGradient id="stoneGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#6b7280"/>
                                <stop offset="100%" style="stop-color:#4b5563"/>
                            </linearGradient>
                        </defs>

                        {{-- Background soft circle --}}
                        <circle cx="240" cy="200" r="190" fill="url(#heroGrad)" opacity="0.08"/>

                        {{-- Lotus flower --}}
                        <g transform="translate(240, 120)">
                            {{-- Petals --}}
                            <ellipse cx="0" cy="-20" rx="18" ry="40" fill="#c4a882" opacity="0.3" transform="rotate(-30)"/>
                            <ellipse cx="0" cy="-20" rx="18" ry="40" fill="#c4a882" opacity="0.4" transform="rotate(-15)"/>
                            <ellipse cx="0" cy="-25" rx="16" ry="38" fill="#d4b896" opacity="0.5"/>
                            <ellipse cx="0" cy="-20" rx="18" ry="40" fill="#c4a882" opacity="0.4" transform="rotate(15)"/>
                            <ellipse cx="0" cy="-20" rx="18" ry="40" fill="#c4a882" opacity="0.3" transform="rotate(30)"/>
                            {{-- Center --}}
                            <circle cx="0" cy="-10" r="8" fill="#a0845c" opacity="0.6"/>
                        </g>

                        {{-- Spa stones stack --}}
                        <ellipse cx="200" cy="280" rx="50" ry="20" fill="url(#stoneGrad)" opacity="0.6" rx="12"/>
                        <ellipse cx="200" cy="260" rx="42" ry="18" fill="#6b7280" opacity="0.7"/>
                        <ellipse cx="200" cy="242" rx="35" ry="15" fill="#9ca3af" opacity="0.6"/>

                        {{-- Candle --}}
                        <rect x="310" y="240" width="24" height="50" rx="4" fill="#e8d5be"/>
                        <ellipse cx="322" cy="240" rx="12" ry="4" fill="#d4b896"/>
                        <ellipse cx="322" cy="234" rx="4" ry="8" fill="#f59e0b" opacity="0.8"/>
                        <ellipse cx="322" cy="230" rx="2" ry="4" fill="#fbbf24" opacity="0.9"/>

                        {{-- Towels --}}
                        <rect x="100" y="300" width="100" height="20" rx="8" fill="#f3ebe0"/>
                        <rect x="105" y="285" width="90" height="18" rx="8" fill="#faf6f1"/>
                        <rect x="110" y="272" width="80" height="16" rx="6" fill="white"/>

                        {{-- Bamboo stems --}}
                        <rect x="370" y="140" width="8" height="160" rx="4" fill="#96a37e" opacity="0.6"/>
                        <rect x="385" y="160" width="6" height="140" rx="3" fill="#7a8963" opacity="0.5"/>
                        <rect x="396" y="180" width="5" height="120" rx="2.5" fill="#96a37e" opacity="0.4"/>
                        {{-- Bamboo leaves --}}
                        <ellipse cx="374" cy="145" rx="20" ry="6" fill="#96a37e" opacity="0.4" transform="rotate(-20, 374, 145)"/>
                        <ellipse cx="388" cy="165" rx="18" ry="5" fill="#7a8963" opacity="0.3" transform="rotate(15, 388, 165)"/>

                        {{-- Water/pool indication --}}
                        <ellipse cx="240" cy="340" rx="180" ry="30" fill="url(#waterGrad)" opacity="0.15"/>

                        {{-- Decorative floating badges --}}
                        <g transform="translate(30, 100)">
                            <rect width="100" height="36" rx="18" fill="white" stroke="#e8d5be" stroke-width="1.5"/>
                            <circle cx="20" cy="18" r="10" fill="#f3ebe0"/>
                            <text x="20" y="22" font-size="11" text-anchor="middle" fill="#8b6f47">✦</text>
                            <text x="55" y="15" font-size="9" fill="#374151" font-family="Inter, sans-serif" font-weight="600">Premium</text>
                            <text x="55" y="27" font-size="8" fill="#6b7280" font-family="Inter, sans-serif">Quality</text>
                        </g>

                        <g transform="translate(355, 60)">
                            <rect width="100" height="36" rx="18" fill="white" stroke="#e8d5be" stroke-width="1.5"/>
                            <circle cx="20" cy="18" r="10" fill="#e8ebe2"/>
                            <text x="20" y="23" font-size="10" text-anchor="middle" fill="#606d4e">🌿</text>
                            <text x="60" y="15" font-size="9" fill="#374151" font-family="Inter, sans-serif" font-weight="600">Natural</text>
                            <text x="60" y="27" font-size="8" fill="#6b7280" font-family="Inter, sans-serif">Ingredients</text>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     LAYANAN UNGGULAN SECTION
══════════════════════════════════════════════ --}}
<section class="py-20 bg-white" id="layanan-unggulan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-14 animate-on-scroll">
            <div class="section-badge mx-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                Menu Treatment
            </div>
            <h2 class="section-title">Treatment <span class="text-gradient">Terbaik</span> untuk Anda</h2>
            <p class="section-subtitle max-w-xl mx-auto">
                Pilih perawatan yang sesuai kebutuhan Anda. Semua treatment ditangani oleh terapis bersertifikat dan berpengalaman.
            </p>
        </div>

        {{-- Service Cards Grid --}}
        @if($layanans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($layanans as $index => $layanan)
            <div class="card animate-on-scroll delay-{{ ($index + 1) * 100 }}" id="layanan-card-{{ $loop->index }}">
                {{-- Thumbnail / Icon --}}
                <div class="h-48 bg-gradient-to-br from-spa-50 to-cream-200 relative overflow-hidden flex items-center justify-center">
                    @if($layanan->thumbnail)
                        <img src="{{ Storage::disk('public')->url($layanan->thumbnail) }}"
                             alt="{{ $layanan->judul }}"
                             class="w-full h-full object-cover">
                    @else
                        {{-- Default SVG icon for layanan --}}
                        <svg viewBox="0 0 200 160" xmlns="http://www.w3.org/2000/svg" class="w-40 h-32 opacity-80">
                            <defs>
                                <linearGradient id="serviceGrad{{ $loop->index }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#c4a882;stop-opacity:0.2"/>
                                    <stop offset="100%" style="stop-color:#8b6f47;stop-opacity:0.2"/>
                                </linearGradient>
                            </defs>
                            <circle cx="100" cy="80" r="70" fill="url(#serviceGrad{{ $loop->index }})"/>
                            <rect x="60" y="45" width="80" height="70" rx="10" fill="white" stroke="#e8d5be" stroke-width="2"/>
                            <rect x="70" y="55" width="60" height="8" rx="3" fill="#e8d5be"/>
                            <rect x="70" y="70" width="40" height="6" rx="2" fill="#f3ebe0"/>
                            <rect x="70" y="82" width="50" height="6" rx="2" fill="#f3ebe0"/>
                            <rect x="70" y="94" width="35" height="6" rx="2" fill="#f3ebe0"/>
                            <circle cx="100" cy="55" r="18" fill="#c4a882" opacity="0.15"/>
                            <text x="100" y="60" font-size="14" text-anchor="middle" fill="#8b6f47">✦</text>
                        </svg>
                    @endif

                    {{-- Urutan badge --}}
                    <div class="absolute top-3 right-3 w-7 h-7 bg-spa-600 text-white text-xs font-bold rounded-full flex items-center justify-center shadow">
                        {{ $layanan->urutan }}
                    </div>
                </div>

                <div class="card-body">
                    <h3 class="text-lg font-heading font-bold text-gray-800 mb-2">{{ $layanan->judul }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ Str::limit($layanan->deskripsi, 110) }}</p>
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment:%20{{ urlencode($layanan->judul) }}"
                       target="_blank"
                       class="inline-flex items-center gap-1.5 text-spa-600 hover:text-spa-700 font-semibold text-sm transition-colors duration-200">
                        Booking Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- CTA to full layanan page --}}
        <div class="text-center mt-12 animate-on-scroll">
            <a href="{{ route('layanan') }}" class="btn-secondary" id="all-layanan-btn">
                Lihat Semua Treatment
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     WHY CHOOSE US SECTION
══════════════════════════════════════════════ --}}
<section class="py-20 bg-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- Features List --}}
            <div class="animate-on-scroll">
                <div class="section-badge">Mengapa Pilih Kami</div>
                <h2 class="section-title mb-6">Kami <span class="text-gradient">Hadir</span> untuk Kenyamanan Anda</h2>
                <p class="text-gray-500 mb-8 leading-relaxed">Spa premium dengan standar pelayanan terbaik, menggunakan produk berkualitas tinggi dan ditangani oleh terapis berpengalaman.</p>

                <div class="space-y-5">
                    @php
                    $features = [
                        ['icon' => '🌿', 'title' => 'Produk Alami Premium', 'desc' => 'Menggunakan produk perawatan organik dan natural yang aman untuk semua jenis kulit.'],
                        ['icon' => '💆', 'title' => 'Terapis Bersertifikat', 'desc' => 'Ditangani langsung oleh terapis profesional bersertifikat dengan pengalaman bertahun-tahun.'],
                        ['icon' => '🏛️', 'title' => 'Suasana Mewah & Tenang', 'desc' => 'Ruangan yang dirancang khusus untuk menciptakan suasana relaksasi maksimal dan nyaman.'],
                        ['icon' => '✨', 'title' => 'Treatment Terpersonalisasi', 'desc' => 'Setiap treatment disesuaikan dengan kebutuhan dan kondisi kulit Anda.'],
                    ];
                    @endphp
                    @foreach($features as $i => $feature)
                    <div class="flex items-start gap-4 animate-on-scroll delay-{{ ($i + 1) * 100 }}" id="feature-{{ $i }}">
                        <div class="w-12 h-12 bg-spa-100 rounded-xl flex items-center justify-center flex-shrink-0 text-xl">
                            {{ $feature['icon'] }}
                        </div>
                        <div>
                            <h3 class="font-heading font-semibold text-gray-800 mb-1">{{ $feature['title'] }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Visual --}}
            <div class="animate-on-scroll delay-200">
                <svg viewBox="0 0 480 400" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                    <defs>
                        <linearGradient id="whyGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#faf6f1"/>
                            <stop offset="100%" style="stop-color:#f6f7f4"/>
                        </linearGradient>
                    </defs>
                    <rect width="480" height="400" fill="url(#whyGrad)" rx="24"/>

                    {{-- Spa bowl --}}
                    <ellipse cx="240" cy="230" rx="100" ry="35" fill="#d4b896" opacity="0.3"/>
                    <ellipse cx="240" cy="220" rx="90" ry="30" fill="#e8d5be" opacity="0.4"/>
                    <ellipse cx="240" cy="215" rx="80" ry="25" fill="#96a37e" opacity="0.2"/>

                    {{-- Flower petals floating --}}
                    <ellipse cx="220" cy="210" rx="12" ry="6" fill="#c4a882" opacity="0.5" transform="rotate(-20, 220, 210)"/>
                    <ellipse cx="260" cy="205" rx="10" ry="5" fill="#d4b896" opacity="0.4" transform="rotate(15, 260, 205)"/>
                    <ellipse cx="240" cy="200" rx="11" ry="5.5" fill="#c4a882" opacity="0.45"/>

                    {{-- Essential oil bottles --}}
                    <rect x="100" y="160" width="22" height="55" rx="4" fill="#96a37e" opacity="0.6"/>
                    <rect x="100" y="155" width="22" height="10" rx="3" fill="#7a8963" opacity="0.7"/>
                    <rect x="107" y="148" width="8" height="10" rx="2" fill="#606d4e"/>

                    <rect x="130" y="170" width="18" height="45" rx="3" fill="#c4a882" opacity="0.5"/>
                    <rect x="130" y="165" width="18" height="8" rx="3" fill="#a0845c" opacity="0.6"/>
                    <rect x="136" y="158" width="6" height="10" rx="2" fill="#8b6f47"/>

                    {{-- Certification badge --}}
                    <circle cx="360" cy="100" r="50" fill="white" stroke="#e8d5be" stroke-width="2"/>
                    <text x="360" y="90" font-size="24" text-anchor="middle" fill="#8b6f47">✓</text>
                    <text x="360" y="108" font-size="9" text-anchor="middle" fill="#374151" font-family="Inter" font-weight="700">CERTIFIED</text>
                    <text x="360" y="120" font-size="8" text-anchor="middle" fill="#6b7280" font-family="Inter">Premium Spa</text>

                    {{-- Natural badge --}}
                    <rect x="50" y="270" width="140" height="50" rx="14" fill="white" stroke="#e8d5be" stroke-width="1.5"/>
                    <text x="80" y="292" font-size="10" fill="#374151" font-family="Inter" font-weight="600">🌿 100% Natural</text>
                    <text x="80" y="308" font-size="8" fill="#6b7280" font-family="Inter">Organic products</text>

                    {{-- Relaxation badge --}}
                    <rect x="290" y="290" width="130" height="50" rx="14" fill="white" stroke="#e8d5be" stroke-width="1.5"/>
                    <text x="318" y="312" font-size="10" fill="#374151" font-family="Inter" font-weight="600">🧘 Relaksasi</text>
                    <text x="318" y="328" font-size="8" fill="#6b7280" font-family="Inter">Total wellness</text>
                </svg>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     CTA SECTION
══════════════════════════════════════════════ --}}
<section class="py-20 bg-gradient-to-br from-spa-600 to-spa-800 relative overflow-hidden">
    {{-- Decorative --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/20 text-white rounded-full text-sm font-semibold mb-6 border border-white/30">
            🧖 Booking Mudah & Cepat
        </div>
        <h2 class="text-3xl md:text-4xl font-heading font-bold text-white mb-4">
            Siap Memanjakan Diri Anda?
        </h2>
        <p class="text-lg text-spa-100 mb-8 leading-relaxed">
            Hubungi kami sekarang dan jadwalkan treatment spa Anda. Tim kami siap membantu Anda mendapatkan pengalaman relaksasi terbaik.
        </p>
        @if($setting->whatsapp)
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment%20spa"
               target="_blank"
               class="inline-flex items-center gap-2.5 px-8 py-4 bg-white text-spa-600 font-bold rounded-xl hover:bg-cream-100 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-1"
               id="cta-booking-btn">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat WhatsApp Sekarang
            </a>
            @if($setting->telepon)
            <a href="tel:{{ $setting->telepon }}"
               class="inline-flex items-center gap-2 px-8 py-4 border-2 border-white/40 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-200"
               id="cta-call-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Hubungi Kami
            </a>
            @endif
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const words = ["Ketenangan", "Kecantikan", "Relaksasi", "Kesegaran"];
        const dynamicText = document.querySelector('.dynamic-text');
        let i = 0;

        if (dynamicText) {
            setInterval(() => {
                // Fade out
                dynamicText.style.opacity = '0';
                dynamicText.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    // Change text and Fade in
                    i = (i + 1) % words.length;
                    dynamicText.textContent = words[i];
                    dynamicText.style.opacity = '1';
                    dynamicText.style.transform = 'translateY(0)';
                }, 500);
            }, 3000);
        }
    });
</script>
@endpush

@endsection

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Meta Tags --}}
    <title>@yield('title', $setting->nama_situs ?? 'Luxury Spa & Wellness') | {{ $setting->nama_situs ?? 'Luxury Spa & Wellness' }}</title>
    <meta name="description" content="@yield('meta_description', $setting->deskripsi_situs ?? 'Spa & Wellness premium untuk relaksasi dan kecantikan Anda.')">
    <meta name="keywords" content="{{ ($setting->meta_seo['keywords'] ?? 'spa, wellness, massage, facial, body treatment, relaksasi') }}">
    <meta name="author" content="{{ $setting->meta_seo['author'] ?? 'Luxury Spa & Wellness' }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', $setting->nama_situs ?? 'Luxury Spa & Wellness')">
    <meta property="og:description" content="@yield('meta_description', $setting->deskripsi_situs ?? '')">
    @if($setting->gambar_og)
    <meta property="og:image" content="{{ Storage::disk('public')->url($setting->gambar_og) }}">
    @endif
    <meta property="og:locale" content="id_ID">

    {{-- Favicon --}}
    @if($setting->favicon)
    <link rel="icon" type="image/x-icon" href="{{ Storage::disk('public')->url($setting->favicon) }}">
    @else
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='8' fill='%238b6f47'/><text y='24' x='4' font-size='22'>🧖</text></svg>">
    @endif

    {{-- Google Fonts preconnect --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Analytics --}}
    @if(!empty($setting->meta_seo['google_analytics']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->meta_seo['google_analytics'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $setting->meta_seo['google_analytics'] }}');
    </script>
    @endif

    @stack('styles')
</head>
<body class="antialiased">

    {{-- ══════════════════════════════════════════
         NAVBAR
    ══════════════════════════════════════════ --}}
    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/90 backdrop-blur-md border-b border-spa-100/50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                {{-- Logo --}}
                <a href="{{ route('beranda') }}" class="flex items-center gap-3 group">
                    @if($setting->logo)
                        <img src="{{ Storage::disk('public')->url($setting->logo) }}"
                             alt="{{ $setting->nama_situs }}"
                             class="h-10 w-auto group-hover:scale-105 transition-transform duration-200">
                    @else
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 bg-gradient-to-br from-spa-500 to-spa-700 rounded-xl flex items-center justify-center shadow-md">
                                {{-- Lotus/Leaf icon --}}
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 007.92 12.446A9 9 0 1112 2.992z M17 8C8 10 5.9 16.17 3.82 21.34l1.89-.66c1-2.5 3-5.68 7.29-7.68M17 8c-3 2-5 6-6 11M17 8c3 1 6 4 7 8"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-heading font-bold text-gray-800 leading-none text-base">{{ $setting->nama_situs ?? 'Luxury Spa' }}</div>
                                @if($setting->slogan)
                                <div class="text-xs text-spa-500 font-medium leading-none mt-0.5">{{ Str::limit($setting->slogan, 35) }}</div>
                                @endif
                            </div>
                        </div>
                    @endif
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-1">
                    @php
                        $navItems = [
                            ['route' => 'beranda',    'label' => 'Beranda'],
                            ['route' => 'tentang',    'label' => 'Tentang Kami'],
                            ['route' => 'layanan',    'label' => 'Layanan'],
                            ['route' => 'pricelist',  'label' => 'Pricelist'],
                            ['route' => 'testimoni',  'label' => 'Testimoni'],
                            ['route' => 'artikel',    'label' => 'Artikel'],
                            ['route' => 'faq',        'label' => 'FAQ'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="nav-link px-4 py-2 rounded-lg {{ request()->routeIs($item['route'] . '*') ? 'text-spa-600 bg-spa-50 font-semibold' : '' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                {{-- CTA Button + Mobile Toggle --}}
                <div class="flex items-center gap-3">
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment%20spa"
                       target="_blank" rel="noopener"
                       class="hidden sm:inline-flex btn-primary text-sm px-4 py-2.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Booking Sekarang
                    </a>
                    @endif

                    {{-- Mobile hamburger --}}
                    <button id="menu-toggle" aria-expanded="false" aria-label="Toggle menu"
                            class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-cream-100 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden lg:hidden border-t border-spa-100 py-3 space-y-1">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-spa-50 hover:text-spa-600 font-medium transition-colors duration-200 {{ request()->routeIs($item['route'] . '*') ? 'bg-spa-50 text-spa-600' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                @if($setting->whatsapp)
                <div class="px-4 pt-2 pb-3">
                    <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment%20spa"
                       target="_blank" rel="noopener"
                       class="btn-primary w-full justify-center text-sm">
                        🧖 Booking Sekarang
                    </a>
                </div>
                @endif
            </div>
        </nav>
    </header>

    {{-- ══════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════ --}}
    <main class="pt-16 lg:pt-20">
        @yield('content')
    </main>

    {{-- ══════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════ --}}
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Footer Top --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 py-14">

                {{-- Brand --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 bg-gradient-to-br from-spa-400 to-spa-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 007.92 12.446A9 9 0 1112 2.992z M17 8C8 10 5.9 16.17 3.82 21.34l1.89-.66c1-2.5 3-5.68 7.29-7.68M17 8c-3 2-5 6-6 11M17 8c3 1 6 4 7 8"/>
                            </svg>
                        </div>
                        <span class="font-heading font-bold text-white text-lg">{{ $setting->nama_situs ?? 'Luxury Spa' }}</span>
                    </div>
                    @if($setting->slogan)
                    <p class="text-spa-300 font-medium mb-3 italic">"{{ $setting->slogan }}"</p>
                    @endif
                    @if($setting->deskripsi_situs)
                    <p class="text-sm text-gray-400 leading-relaxed mb-5">{{ $setting->deskripsi_situs }}</p>
                    @endif

                    {{-- Social Media --}}
                    @php $sosmed = $setting->media_sosial ?? []; @endphp
                    @if(array_filter($sosmed))
                    <div class="flex items-center gap-3">
                        @if(!empty($sosmed['facebook']))
                        <a href="{{ $sosmed['facebook'] }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors duration-200" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if(!empty($sosmed['instagram']))
                        <a href="{{ $sosmed['instagram'] }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors duration-200" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        @endif
                        @if(!empty($sosmed['youtube']))
                        <a href="{{ $sosmed['youtube'] }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition-colors duration-200" aria-label="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        </a>
                        @endif
                        @if(!empty($sosmed['tiktok']))
                        <a href="{{ $sosmed['tiktok'] }}" target="_blank" rel="noopener"
                           class="w-9 h-9 bg-gray-800 hover:bg-gray-600 rounded-lg flex items-center justify-center transition-colors duration-200" aria-label="TikTok">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- Kontak --}}
                <div>
                    <h3 class="font-heading font-bold text-white mb-5 text-sm uppercase tracking-wider">Kontak</h3>
                    <ul class="space-y-3 text-sm">
                        @if($setting->alamat)
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-spa-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-400">{{ $setting->alamat }}</span>
                        </li>
                        @endif
                        @if($setting->telepon)
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-spa-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ $setting->telepon }}" class="text-gray-400 hover:text-spa-300 transition-colors">{{ $setting->telepon }}</a>
                        </li>
                        @endif
                        @if($setting->whatsapp)
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank" class="text-gray-400 hover:text-green-400 transition-colors">+{{ $setting->whatsapp }}</a>
                        </li>
                        @endif
                        @if($setting->email)
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-spa-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $setting->email }}" class="text-gray-400 hover:text-spa-300 transition-colors">{{ $setting->email }}</a>
                        </li>
                        @endif
                    </ul>
                </div>

                {{-- Jam Operasional --}}
                <div>
                    <h3 class="font-heading font-bold text-white mb-5 text-sm uppercase tracking-wider">Jam Operasional</h3>
                    @php $jams = $setting->jam_operasional ?? []; @endphp
                    @if(count($jams) > 0)
                    <ul class="space-y-3 text-sm">
                        @foreach($jams as $jam)
                        <li class="flex items-center justify-between">
                            <span class="text-gray-400">{{ $jam['hari'] ?? '' }}</span>
                            <span class="text-spa-300 font-medium text-xs px-2 py-0.5 bg-spa-900/50 rounded-md">{{ $jam['jam'] ?? '' }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            {{-- Footer Bottom --}}
            <div class="border-t border-gray-800 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
                <p>© {{ date('Y') }} <span class="text-gray-400 font-medium">{{ $setting->nama_perusahaan ?? $setting->nama_situs ?? 'Luxury Spa' }}</span>. All rights reserved.</p>
                <p>Relaksasi & Keindahan untuk Anda ✨</p>
            </div>
        </div>
    </footer>

    {{-- ══════════════════════════════════════════
         FLOATING ACTION BUTTON WhatsApp
    ══════════════════════════════════════════ --}}
    @if($setting->whatsapp)
    <div class="fab-whatsapp" aria-label="Hubungi via WhatsApp">
        <div class="relative">
            <span class="pulse-ring"></span>
            <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20spa"
               target="_blank" rel="noopener"
               title="Chat via WhatsApp"
               aria-label="Chat WhatsApp">
                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </a>
        </div>
    </div>
    @endif

    @stack('scripts')
</body>
</html>

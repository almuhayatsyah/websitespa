@extends('layouts.app')

@section('title', 'Menu Treatment Spa')
@section('meta_description', 'Lihat semua menu treatment spa kami. Mulai dari facial, body massage, body scrub, hingga paket wellness premium.')

@section('content')

{{-- Page Hero --}}
<section class="bg-gradient-to-br from-spa-50 to-cream-200 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="section-badge mx-auto">Menu Treatment</div>
        <h1 class="section-title mt-2">Semua <span class="text-gradient">Treatment Spa</span></h1>
        <p class="section-subtitle max-w-xl mx-auto">Pilih perawatan yang sesuai dengan kebutuhan Anda. Semua ditangani oleh terapis profesional bersertifikat.</p>
    </div>
</section>

{{-- Services Grid --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($layanans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($layanans as $index => $layanan)
            <div class="card group animate-on-scroll delay-{{ min(($index % 3 + 1) * 100, 300) }}" id="layanan-grid-{{ $loop->index }}">
                {{-- Thumbnail --}}
                <div class="h-52 bg-gradient-to-br from-spa-50 to-cream-200 relative overflow-hidden">
                    @if($layanan->thumbnail)
                        <img src="{{ Storage::disk('public')->url($layanan->thumbnail) }}"
                             alt="{{ $layanan->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg viewBox="0 0 200 160" xmlns="http://www.w3.org/2000/svg" class="w-36 h-28">
                                <defs>
                                    <linearGradient id="lGrad{{ $index }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#c4a882;stop-opacity:0.15"/>
                                        <stop offset="100%" style="stop-color:#8b6f47;stop-opacity:0.15"/>
                                    </linearGradient>
                                </defs>
                                <circle cx="100" cy="80" r="70" fill="url(#lGrad{{ $index }})"/>
                                <rect x="60" y="45" width="80" height="70" rx="10" fill="white" stroke="#e8d5be" stroke-width="2"/>
                                <rect x="70" y="55" width="60" height="8" rx="3" fill="#e8d5be"/>
                                <rect x="70" y="70" width="40" height="6" rx="2" fill="#f3ebe0"/>
                                <rect x="70" y="82" width="50" height="6" rx="2" fill="#f3ebe0"/>
                                <circle cx="100" cy="55" r="18" fill="#c4a882" opacity="0.15"/>
                                <text x="100" y="60" font-size="14" text-anchor="middle" fill="#8b6f47">✦</text>
                            </svg>
                        </div>
                    @endif

                    {{-- Active indicator --}}
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-sage-500 text-white text-xs font-semibold rounded-full">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Tersedia
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <h2 class="text-lg font-heading font-bold text-gray-800 mb-2 group-hover:text-spa-600 transition-colors duration-200">
                        {{ $layanan->judul }}
                    </h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $layanan->deskripsi }}</p>

                    {{-- Features --}}
                    <ul class="space-y-1.5 mb-6">
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-sage-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                            Terapis bersertifikat
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-sage-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                            Produk alami premium
                        </li>
                        <li class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="w-3.5 h-3.5 text-sage-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                            Ruangan private & nyaman
                        </li>
                    </ul>

                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment:%20{{ urlencode($layanan->judul) }}"
                       target="_blank"
                       class="btn-primary w-full justify-center text-sm"
                       id="booking-layanan-{{ $loop->index }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Booking Treatment Ini
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-spa-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">🧖</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Treatment</h3>
            <p class="text-gray-500">Menu treatment akan segera ditambahkan.</p>
        </div>
        @endif
    </div>
</section>

@endsection

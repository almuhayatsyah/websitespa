@extends('layouts.app')

@section('title', 'Artikel & Tips Kecantikan')
@section('meta_description', 'Baca artikel informatif seputar kecantikan, wellness, perawatan tubuh, dan tips spa dari para ahli kami.')

@section('content')

{{-- Page Hero --}}
<section class="bg-gradient-to-br from-emerald-50 to-sage-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-sage-100 text-sage-700 rounded-full text-sm font-semibold mb-4">
            📰 Artikel & Tips
        </div>
        <h1 class="section-title mt-2">Informasi & <span class="text-gradient">Edukasi</span></h1>
        <p class="section-subtitle max-w-xl mx-auto">Baca artikel informatif seputar kecantikan, wellness, dan tips perawatan tubuh dari para ahli kami.</p>
    </div>
</section>

{{-- Articles Grid --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($artikels->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($artikels as $index => $artikel)
            <article class="card group animate-on-scroll delay-{{ min(($index % 3 + 1) * 100, 300) }}" id="artikel-card-{{ $loop->index }}">
                {{-- Thumbnail --}}
                <a href="{{ route('artikel.show', $artikel) }}" class="block h-52 overflow-hidden">
                    @if($artikel->thumbnail)
                        <img src="{{ Storage::disk('public')->url($artikel->thumbnail) }}"
                             alt="{{ $artikel->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-spa-50 to-cream-200 flex items-center justify-center">
                            <svg viewBox="0 0 200 160" xmlns="http://www.w3.org/2000/svg" class="w-36 h-28">
                                <defs>
                                    <linearGradient id="artGrad{{ $index }}" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#c4a882;stop-opacity:0.15"/>
                                        <stop offset="100%" style="stop-color:#8b6f47;stop-opacity:0.15"/>
                                    </linearGradient>
                                </defs>
                                <rect width="200" height="160" fill="url(#artGrad{{ $index }})"/>
                                <rect x="55" y="25" width="90" height="110" rx="8" fill="white" stroke="#e8d5be" stroke-width="1.5"/>
                                <rect x="65" y="40" width="70" height="8" rx="3" fill="#c4a882" opacity="0.4"/>
                                <rect x="65" y="56" width="60" height="5" rx="2" fill="#e8d5be"/>
                                <rect x="65" y="68" width="70" height="5" rx="2" fill="#e8d5be"/>
                                <rect x="65" y="80" width="50" height="5" rx="2" fill="#e8d5be"/>
                                <rect x="65" y="92" width="65" height="5" rx="2" fill="#e8d5be"/>
                                <rect x="65" y="104" width="40" height="5" rx="2" fill="#e8d5be"/>
                            </svg>
                        </div>
                    @endif
                </a>

                <div class="card-body">
                    {{-- Date --}}
                    <div class="flex items-center gap-2 mb-3">
                        <span class="tag">Beauty & Wellness</span>
                        <span class="text-xs text-gray-400">
                            {{ $artikel->tanggal_terbit ? $artikel->tanggal_terbit->isoFormat('D MMM YYYY') : $artikel->created_at->isoFormat('D MMM YYYY') }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h2 class="text-base font-heading font-bold text-gray-800 mb-2 leading-snug group-hover:text-spa-600 transition-colors duration-200">
                        <a href="{{ route('artikel.show', $artikel) }}">{{ $artikel->judul }}</a>
                    </h2>

                    {{-- Excerpt --}}
                    @if($artikel->deskripsi)
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">{{ $artikel->deskripsi }}</p>
                    @endif

                    {{-- Read More --}}
                    <a href="{{ route('artikel.show', $artikel) }}"
                       class="inline-flex items-center gap-1.5 text-spa-600 hover:text-spa-700 font-semibold text-sm transition-colors duration-200"
                       id="baca-artikel-{{ $loop->index }}">
                        Baca Selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($artikels->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $artikels->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-sage-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">📰</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Artikel</h3>
            <p class="text-gray-500">Artikel akan segera diterbitkan.</p>
        </div>
        @endif
    </div>
</section>

@endsection

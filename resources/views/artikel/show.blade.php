@extends('layouts.app')

@section('title', $artikel->judul)
@section('meta_description', $artikel->deskripsi ?? Str::limit(strip_tags($artikel->konten), 160))

@section('content')

<article class="py-12 lg:py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8" aria-label="breadcrumb">
            <a href="{{ route('beranda') }}" class="hover:text-spa-600 transition-colors">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('artikel') }}" class="hover:text-spa-600 transition-colors">Artikel</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium">{{ Str::limit($artikel->judul, 40) }}</span>
        </nav>

        {{-- Header --}}
        <header class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <span class="tag">Beauty & Wellness</span>
                @if($artikel->tanggal_terbit)
                <span class="text-sm text-gray-400">{{ $artikel->tanggal_terbit->isoFormat('dddd, D MMMM YYYY') }}</span>
                @endif
            </div>

            <h1 class="text-3xl md:text-4xl font-heading font-bold text-gray-800 leading-tight mb-4">
                {{ $artikel->judul }}
            </h1>

            @if($artikel->deskripsi)
            <p class="text-lg text-gray-500 leading-relaxed border-l-4 border-spa-400 pl-4">
                {{ $artikel->deskripsi }}
            </p>
            @endif
        </header>

        {{-- Thumbnail --}}
        @if($artikel->thumbnail)
        <div class="mb-10 rounded-2xl overflow-hidden shadow-soft">
            <img src="{{ Storage::disk('public')->url($artikel->thumbnail) }}"
                 alt="{{ $artikel->judul }}"
                 class="w-full h-72 md:h-96 object-cover">
        </div>
        @endif

        {{-- Content --}}
        <div class="prose prose-lg prose-spa max-w-none
                    prose-headings:font-heading prose-headings:text-gray-800
                    prose-p:text-gray-600 prose-p:leading-relaxed
                    prose-a:text-spa-600 prose-a:no-underline hover:prose-a:underline
                    prose-strong:text-gray-800
                    prose-ul:text-gray-600 prose-ol:text-gray-600
                    prose-li:my-1
                    prose-blockquote:border-spa-400 prose-blockquote:text-gray-600
                    prose-img:rounded-xl prose-img:shadow-card">
            {!! $artikel->konten !!}
        </div>

        {{-- Share --}}
        <div class="mt-12 pt-8 border-t border-gray-100">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <div class="text-sm font-semibold text-gray-700 mb-1">Bagikan artikel ini:</div>
                    <div class="flex items-center gap-2">
                        {{-- WhatsApp Share --}}
                        <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . request()->url()) }}"
                           target="_blank" rel="noopener"
                           class="w-9 h-9 bg-green-500 hover:bg-green-600 rounded-lg flex items-center justify-center transition-colors duration-200"
                           aria-label="Bagikan ke WhatsApp">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                        {{-- Copy link --}}
                        <button onclick="navigator.clipboard.writeText('{{ request()->url() }}').then(() => alert('Link disalin!'))"
                                class="w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors duration-200"
                                aria-label="Salin link artikel">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <a href="{{ route('artikel') }}" class="btn-secondary text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Artikel
                </a>
            </div>
        </div>

        {{-- Related CTA --}}
        @if($setting->whatsapp)
        <div class="mt-10 p-6 bg-gradient-to-br from-spa-50 to-cream-200 rounded-2xl border border-spa-100 flex flex-col sm:flex-row items-center gap-4">
            <div class="flex-1">
                <h3 class="font-heading font-bold text-gray-800 mb-1">Ingin Konsultasi Langsung?</h3>
                <p class="text-sm text-gray-500">Hubungi tim kami melalui WhatsApp untuk konsultasi gratis tentang treatment yang tepat.</p>
            </div>
            <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20baca%20artikel:%20{{ urlencode($artikel->judul) }}%20dan%20ingin%20konsultasi"
               target="_blank"
               class="btn-whatsapp flex-shrink-0"
               id="artikel-konsultasi-btn">
                Konsultasi Gratis
            </a>
        </div>
        @endif
    </div>
</article>

@endsection

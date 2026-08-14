@extends('layouts.app')

@section('title', 'Testimoni Pelanggan')
@section('meta_description', 'Baca ulasan dan testimoni dari pelanggan yang telah merasakan layanan spa kami. Rating 4.9/5 dari ribuan pelanggan puas.')

@section('content')

{{-- Page Hero --}}
<section class="bg-gradient-to-br from-amber-50 to-orange-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-sm font-semibold mb-4">
            ⭐ Testimoni Pelanggan
        </div>
        <h1 class="section-title mt-2">Kata Mereka <span class="text-gradient">Tentang Kami</span></h1>
        <p class="section-subtitle max-w-xl mx-auto">Ribuan pelanggan telah mempercayakan momen relaksasi mereka kepada kami.</p>

        {{-- Rating Summary --}}
        <div class="inline-flex items-center gap-3 mt-6 px-6 py-3 bg-white rounded-2xl shadow-soft border border-amber-100">
            <div class="text-4xl font-heading font-bold text-gray-800">4.9</div>
            <div class="text-left">
                <div class="flex items-center gap-0.5 text-amber-400 text-xl">⭐⭐⭐⭐⭐</div>
                <div class="text-xs text-gray-500 mt-0.5">dari ribuan ulasan</div>
            </div>
        </div>
    </div>
</section>

{{-- Testimoni Grid --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($testimonis->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($testimonis as $index => $testimoni)
            <div class="card p-6 animate-on-scroll delay-{{ min(($index % 3 + 1) * 100, 300) }}" id="testimoni-{{ $loop->index }}">

                {{-- Stars --}}
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $testimoni->penilaian ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>

                {{-- Quote --}}
                <div class="relative mb-6">
                    <svg class="w-8 h-8 text-spa-100 absolute -top-2 -left-1" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H6c0-2.2 1.8-4 4-4V8zm14 0c-3.3 0-6 2.7-6 6v10h10V14h-8c0-2.2 1.8-4 4-4V8z"/>
                    </svg>
                    <p class="text-gray-600 leading-relaxed text-sm pl-6 italic">
                        "{{ $testimoni->ulasan }}"
                    </p>
                </div>

                {{-- Patient Info --}}
                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    @if($testimoni->gambar)
                        <img src="{{ Storage::disk('public')->url($testimoni->gambar) }}"
                             alt="{{ $testimoni->nama }}"
                             class="w-11 h-11 rounded-full object-cover ring-2 ring-spa-100">
                    @else
                        {{-- Avatar placeholder using initials --}}
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-spa-400 to-spa-600 flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($testimoni->nama, 0, 2)) }}</span>
                        </div>
                    @endif
                    <div>
                        <div class="font-semibold text-gray-800 text-sm">{{ $testimoni->nama }}</div>
                        @if($testimoni->jabatan || $testimoni->perusahaan)
                        <div class="text-xs text-gray-500 mt-0.5">
                            {{ $testimoni->jabatan }}
                            @if($testimoni->jabatan && $testimoni->perusahaan) · @endif
                            {{ $testimoni->perusahaan }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">⭐</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Testimoni</h3>
            <p class="text-gray-500">Testimoni akan segera ditambahkan.</p>
        </div>
        @endif

        {{-- CTA --}}
        @if($setting->whatsapp)
        <div class="text-center mt-14 animate-on-scroll">
            <div class="inline-block bg-spa-50 rounded-3xl p-8 border border-spa-100 max-w-lg">
                <div class="text-2xl mb-3">💬</div>
                <h3 class="font-heading font-bold text-gray-800 mb-2">Bagikan Pengalaman Anda</h3>
                <p class="text-gray-500 text-sm mb-5">Sudah pernah berkunjung? Kami ingin mendengar pengalaman Anda!</p>
                <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20memberikan%20testimoni%20tentang%20layanan%20spa"
                   target="_blank"
                   class="btn-primary"
                   id="share-testimoni-btn">
                    Berikan Testimoni
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

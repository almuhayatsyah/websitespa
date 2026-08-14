@extends('layouts.app')

@section('title', 'Pricelist Spa')
@section('meta_description', 'Lihat daftar harga treatment spa kami. Mulai dari facial, body massage, body scrub, hair treatment, hingga paket spa premium.')

@section('content')

{{-- Page Hero --}}
<section class="bg-gradient-to-br from-spa-50 to-cream-200 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="section-badge mx-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Daftar Harga
        </div>
        <h1 class="section-title mt-2">Pricelist <span class="text-gradient">Treatment Spa</span></h1>
        <p class="section-subtitle max-w-xl mx-auto">Pilih treatment yang sesuai kebutuhan Anda. Harga terjangkau dengan kualitas premium.</p>
    </div>
</section>

{{-- Pricelist Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($pricelists->count() > 0)

        {{-- Category Tabs --}}
        @if($kategoris->count() > 1)
        <div class="flex flex-wrap justify-center gap-2 mb-12" id="category-tabs">
            <button class="tab-btn active px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 bg-spa-600 text-white shadow-md"
                    data-category="all">
                Semua
            </button>
            @foreach($kategoris as $kategori)
            <button class="tab-btn px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 bg-spa-50 text-spa-700 hover:bg-spa-100 border border-spa-200"
                    data-category="{{ $kategori }}">
                {{ $kategori }}
            </button>
            @endforeach
        </div>
        @endif

        {{-- Pricelist Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7" id="pricelist-grid">
            @foreach($pricelists as $index => $item)
            <div class="card group animate-on-scroll delay-{{ min(($index % 3 + 1) * 100, 300) }} pricelist-card"
                 data-category="{{ $item->kategori }}"
                 id="pricelist-{{ $loop->index }}">

                {{-- Thumbnail --}}
                <div class="h-48 bg-gradient-to-br from-spa-50 to-cream-200 relative overflow-hidden">
                    @if($item->thumbnail)
                        <img src="{{ Storage::disk('public')->url($item->thumbnail) }}"
                             alt="{{ $item->nama }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-4xl mb-2">
                                    @switch($item->kategori)
                                        @case('Body') 💆 @break
                                        @case('Face') 🧴 @break
                                        @case('Hair') 💇 @break
                                        @case('Nail') 💅 @break
                                        @case('Paket') ✨ @break
                                        @default 🌿
                                    @endswitch
                                </div>
                                <span class="text-sm text-spa-500 font-medium">{{ $item->kategori }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Category badge --}}
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2.5 py-1 bg-white/90 backdrop-blur-sm text-spa-700 text-xs font-semibold rounded-full shadow-sm">
                            {{ $item->kategori }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <h3 class="text-lg font-heading font-bold text-gray-800 mb-2 group-hover:text-spa-600 transition-colors duration-200">
                        {{ $item->nama }}
                    </h3>

                    @if($item->deskripsi)
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                    @endif

                    {{-- Price & Duration --}}
                    <div class="flex items-end justify-between mb-5 pt-3 border-t border-gray-100">
                        <div>
                            <div class="text-2xl font-heading font-bold text-spa-600">{{ $item->harga_format }}</div>
                            @if($item->durasi_format)
                            <div class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $item->durasi_format }}
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Booking Button --}}
                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment:%20{{ urlencode($item->nama) }}%20({{ urlencode($item->harga_format) }})"
                       target="_blank"
                       class="btn-primary w-full justify-center text-sm"
                       id="booking-pricelist-{{ $loop->index }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Booking Sekarang
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 bg-spa-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">💰</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Pricelist</h3>
            <p class="text-gray-500">Daftar harga treatment akan segera ditambahkan.</p>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const cards = document.querySelectorAll('.pricelist-card');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const category = this.dataset.category;

                // Update active state
                tabs.forEach(t => {
                    t.classList.remove('active', 'bg-spa-600', 'text-white', 'shadow-md');
                    t.classList.add('bg-spa-50', 'text-spa-700', 'border', 'border-spa-200');
                });
                this.classList.add('active', 'bg-spa-600', 'text-white', 'shadow-md');
                this.classList.remove('bg-spa-50', 'text-spa-700', 'border', 'border-spa-200');

                // Filter cards
                cards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = '';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(10px)';
                        setTimeout(() => {
                            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection

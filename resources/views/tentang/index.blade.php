@extends('layouts.app')

@section('title', 'Tentang Kami')
@section('meta_description', 'Mengenal lebih dekat ' . ($setting->nama_perusahaan ?? 'Luxury Spa & Wellness') . '. Spa premium dengan terapis bersertifikat dan produk berkualitas.')

@section('content')

{{-- ══════════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════════ --}}
<section class="relative py-28 overflow-hidden hero-gradient bg-pattern">
    {{-- Decorative blobs --}}
    <div class="absolute top-10 right-0 w-80 h-80 bg-spa-200/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-96 h-96 bg-sage-200/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto animate-on-scroll">
            <div class="section-badge mx-auto w-fit mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Tentang Kami
            </div>
            <h1 class="section-title mb-6">
                Kenali <span class="text-gradient">{{ $setting->nama_perusahaan ?? 'Luxury Spa' }}</span> Lebih Dekat
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed">
                {{ $setting->deskripsi_situs ?? 'Spa & Wellness premium dengan terapis bersertifikat, memberikan pengalaman relaksasi terbaik untuk tubuh dan pikiran Anda.' }}
            </p>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     VISI MISI
══════════════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Ilustrasi / Visual --}}
            <div class="relative animate-on-scroll">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <div class="bg-gradient-to-br from-spa-500 via-spa-600 to-spa-800 p-12 text-white">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-6 text-center">
                                <div class="text-4xl font-heading font-bold mb-1">5000+</div>
                                <div class="text-sm text-spa-100">Pelanggan Puas</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-6 text-center">
                                <div class="text-4xl font-heading font-bold mb-1">10+</div>
                                <div class="text-sm text-spa-100">Tahun Pengalaman</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-6 text-center">
                                <div class="text-4xl font-heading font-bold mb-1">50+</div>
                                <div class="text-sm text-spa-100">Jenis Treatment</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-6 text-center">
                                <div class="text-4xl font-heading font-bold mb-1">100%</div>
                                <div class="text-sm text-spa-100">Terapis Bersertifikat</div>
                            </div>
                        </div>

                        <div class="mt-8 text-center">
                            <div class="inline-flex items-center gap-2 bg-white/20 rounded-full px-5 py-2 text-sm font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Terpercaya & Bersertifikat
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating badge --}}
                <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3">
                    <div class="w-12 h-12 bg-sage-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-800">Aman & Terjamin</div>
                        <div class="text-xs text-gray-500">Produk alami bersertifikat</div>
                    </div>
                </div>
            </div>

            {{-- Visi Misi Text --}}
            <div class="animate-on-scroll">
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-spa-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-spa-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-heading font-bold text-gray-800">Visi Kami</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed pl-13">
                        {{ $setting->visi ?? 'Menjadi spa & wellness terdepan dan terpercaya di Indonesia.' }}
                    </p>
                </div>

                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-sage-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-heading font-bold text-gray-800">Misi Kami</h2>
                    </div>
                    <ul class="space-y-3 text-gray-600">
                        @if($setting->misi && is_array($setting->misi))
                            @foreach($setting->misi as $misiItem)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-spa-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $misiItem['teks'] ?? '' }}</span>
                            </li>
                            @endforeach
                        @else
                            <li class="text-gray-400 italic">Misi belum diatur</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     NILAI-NILAI KAMI
══════════════════════════════════════════════ --}}
<section class="py-20 bg-cream-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 animate-on-scroll">
            <div class="section-badge mx-auto w-fit mb-4">Nilai-nilai Kami</div>
            <h2 class="section-title">Mengapa Memilih <span class="text-gradient">{{ $setting->nama_perusahaan ?? 'Spa Kami' }}</span>?</h2>
            <p class="section-subtitle">Kami berkomitmen memberikan yang terbaik untuk kenyamanan dan keindahan Anda</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $values = !empty($setting->nilai_nilai) && is_array($setting->nilai_nilai) ? $setting->nilai_nilai : [];
            @endphp

            @foreach($values as $val)
            <div class="card p-6 animate-on-scroll group hover:-translate-y-1 transition-transform duration-300">
                <div class="w-12 h-12 bg-{{ $val['color'] }}-100 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-{{ $val['color'] }}-200 transition-colors duration-300">
                    <svg class="w-6 h-6 text-{{ $val['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $val['icon'] !!}
                    </svg>
                </div>
                <h3 class="font-heading font-semibold text-gray-800 text-lg mb-2">{{ $val['title'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $val['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     TIM KLINIK
══════════════════════════════════════════════ --}}
@if(!empty($setting->tim_klinik) && count($setting->tim_klinik) > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 animate-on-scroll">
            <div class="section-badge mx-auto w-fit mb-4">Tim Kami</div>
            <h2 class="section-title">Kenali Tim <span class="text-gradient">Profesional</span> Kami</h2>
            <p class="section-subtitle">Para terapis dan staf yang siap memberikan pelayanan terbaik untuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($setting->tim_klinik as $anggota)
            <div class="card overflow-hidden group animate-on-scroll">
                <div class="aspect-[4/5] relative overflow-hidden bg-gray-100">
                    @if(!empty($anggota['foto']))
                        <img src="{{ Storage::url($anggota['foto']) }}" alt="{{ $anggota['nama'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="font-heading font-semibold text-gray-900 text-lg mb-1">{{ $anggota['nama'] ?? 'Nama Tidak Diketahui' }}</h3>
                    <p class="text-spa-600 text-sm font-medium">{{ $anggota['jabatan'] ?? 'Staf' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════
     INFORMASI KONTAK
══════════════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            {{-- Informasi Kontak --}}
            <div class="animate-on-scroll">
                <div class="section-badge mb-4">Informasi Spa</div>
                <h2 class="section-title mb-8">Temukan <span class="text-gradient">Kami</span></h2>

                <div class="space-y-5">
                    @if($setting->alamat)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-spa-100 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5 text-spa-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 mb-1">Alamat</div>
                            <div class="text-gray-600">{{ $setting->alamat }}{{ $setting->kode_pos ? ', ' . $setting->kode_pos : '' }}</div>
                        </div>
                    </div>
                    @endif

                    @if($setting->telepon)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-spa-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-spa-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 mb-1">Telepon</div>
                            <a href="tel:{{ $setting->telepon }}" class="text-spa-600 hover:text-spa-700 font-medium">{{ $setting->telepon }}</a>
                        </div>
                    </div>
                    @endif

                    @if($setting->whatsapp)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 mb-1">WhatsApp</div>
                            <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank" class="text-green-600 hover:text-green-700 font-medium">+{{ $setting->whatsapp }}</a>
                        </div>
                    </div>
                    @endif

                    @if($setting->email)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-spa-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-spa-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 mb-1">Email</div>
                            <a href="mailto:{{ $setting->email }}" class="text-spa-600 hover:text-spa-700 font-medium">{{ $setting->email }}</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Jam Operasional --}}
            <div class="animate-on-scroll">
                <div class="section-badge mb-4">Jam Operasional</div>
                <h2 class="section-title mb-8">Kapan Kami <span class="text-gradient">Buka</span>?</h2>

                @if(!empty($setting->jam_operasional))
                <div class="card overflow-hidden">
                    @foreach($setting->jam_operasional as $index => $jadwal)
                    <div class="flex items-center justify-between px-6 py-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }} {{ $loop->first ? 'bg-spa-50' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full {{ $loop->first ? 'bg-spa-500' : 'bg-gray-300' }}"></div>
                            <span class="font-medium text-gray-800">{{ $jadwal['hari'] ?? '' }}</span>
                        </div>
                        <span class="text-sm font-semibold {{ $loop->first ? 'text-spa-600' : 'text-gray-600' }}">
                            {{ $jadwal['jam'] ?? '' }}
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card p-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>Jam operasional belum diatur</p>
                </div>
                @endif

                @if($setting->whatsapp)
                <div class="mt-6 p-5 bg-green-50 rounded-2xl border border-green-100 flex items-center gap-4">
                    <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800 text-sm">Hubungi Kami</div>
                        <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20spa"
                           target="_blank" class="text-green-600 hover:text-green-700 text-sm font-medium">
                            Chat WhatsApp Sekarang →
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     CTA SECTION
══════════════════════════════════════════════ --}}
<section class="py-20 bg-gradient-to-br from-spa-600 via-spa-700 to-spa-800 relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-spa-400/10 rounded-full blur-2xl"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll">
        <h2 class="text-3xl lg:text-4xl font-heading font-bold text-white mb-4">
            Siap Memanjakan Diri Anda?
        </h2>
        <p class="text-spa-100 text-lg mb-8 max-w-2xl mx-auto">
            Jadwalkan treatment spa Anda sekarang dan rasakan pengalaman relaksasi yang tak terlupakan.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            @if($setting->whatsapp)
            <a href="https://wa.me/{{ $setting->whatsapp }}?text=Halo,%20saya%20ingin%20booking%20treatment%20spa"
               target="_blank"
               class="inline-flex items-center gap-3 bg-white text-spa-700 font-semibold px-8 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Booking via WhatsApp
            </a>
            @endif
            <a href="{{ route('layanan') }}"
               class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white border border-white/20 font-semibold px-8 py-4 rounded-2xl hover:bg-white/20 transition-all duration-200">
                Lihat Menu Treatment
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection

@extends('layouts.app', ['title' => 'Galeri Kegiatan - SITANI'])

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:justify-between items-start md:items-end gap-6 mb-10">
    <div>
        <div class="text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-2">
            DOKUMENTASI LAPANGAN
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-sitani-primary tracking-tight mb-2">
            Galeri Kegiatan
        </h1>
    </div>
    <div class="max-w-md">
        <p class="text-sm text-sitani-text-muted leading-relaxed">
            Potret kerja harian, musyawarah warga, dan perputaran daur hidup pertanian lestari bersama kelompok tani desa.
        </p>
    </div>
</div>

<!-- Dynamic Photo Grid -->
@if(isset($kegiatan) && $kegiatan->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        @foreach($kegiatan as $item)
        <div class="bg-sitani-card rounded-2xl border border-sitani-border/80 overflow-hidden shadow-sm group flex flex-col">
            <div class="aspect-[4/3] w-full overflow-hidden bg-gray-200">
                <img src="{{ Storage::url($item->bukti_foto) }}" alt="{{ $item->kategori_kegiatan }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
            </div>
            <div class="p-5 bg-sitani-card flex-grow flex flex-col">
                <h3 class="text-base font-bold text-sitani-text-main mb-2">{{ $item->kategori_kegiatan }}</h3>
                <p class="text-sm text-sitani-text-muted line-clamp-3">
                    {{ $item->deskripsi }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-sitani-card rounded-2xl border border-sitani-border/80 p-10 text-center shadow-sm">
        <div class="text-sitani-text-muted mb-2">
            <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-sitani-text-main mb-2">Belum Ada Foto</h3>
        <p class="text-sm text-sitani-text-muted">Dokumentasi kegiatan akan segera ditambahkan di sini.</p>
    </div>
@endif
@endsection
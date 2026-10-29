@extends('layouts.app', ['title' => 'Program - SITANI'])

@section('content')
<!-- Header Section -->
<div class="mb-10">
    <div class="text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-2">
        PILAR INISIATIF
    </div>
    <h1 class="text-3xl md:text-4xl font-extrabold text-sitani-primary tracking-tight mb-3">
        Program Kami
    </h1>
    <p class="text-sm md:text-base text-sitani-text-muted">
        Inisiatif pemberdayaan yang sedang berjalan di tingkat tapak.
    </p>
</div>

<!-- Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
    <!-- Card 1 -->
    <div class="bg-sitani-card rounded-2xl border border-sitani-border/80 overflow-hidden shadow-sm flex flex-col">
        <div class="aspect-[16/10] w-full object-cover relative bg-gray-200 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1592982537447-6f23b28b7596?auto=format&fit=crop&w=800&q=80" alt="Pendampingan Pertanian Alami" class="w-full h-full object-cover" loading="lazy">
            <div class="absolute top-3.5 left-3.5 px-2.5 py-1 rounded bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium tracking-wide">
                01 / Ekologi
            </div>
        </div>
        <div class="p-6 flex flex-col flex-grow justify-between">
            <div>
                <h2 class="text-lg font-bold text-sitani-primary mb-2.5">Pendampingan Pertanian Alami</h2>
                <p class="text-sm text-sitani-text-muted leading-relaxed mb-6">
                    Pelatihan pembuatan pupuk hayati mandiri dan konservasi tanah untuk meningkatkan kesuburan lahan warga.
                </p>
            </div>
            <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-sitani-primary hover:text-sitani-mid transition-colors mt-auto">
                Inisiatif Lapangan &rarr;
            </a>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-sitani-card rounded-2xl border border-sitani-border/80 overflow-hidden shadow-sm flex flex-col">
        <div class="aspect-[16/10] w-full object-cover relative bg-gray-200 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1627987258900-580749a5b326?auto=format&fit=crop&w=800&q=80" alt="Kolektif Lumbung Panen" class="w-full h-full object-cover" loading="lazy">
            <div class="absolute top-3.5 left-3.5 px-2.5 py-1 rounded bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium tracking-wide">
                02 / Pasca-Panen
            </div>
        </div>
        <div class="p-6 flex flex-col flex-grow justify-between">
            <div>
                <h2 class="text-lg font-bold text-sitani-primary mb-2.5">Kolektif Lumbung Panen</h2>
                <p class="text-sm text-sitani-text-muted leading-relaxed mb-6">
                    Penyediaan fasilitas penyimpanan bersama agar hasil panen tidak anjlok saat musim raya tiba.
                </p>
            </div>
            <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-sitani-primary hover:text-sitani-mid transition-colors mt-auto">
                Manajemen Komunal &rarr;
            </a>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-sitani-card rounded-2xl border border-sitani-border/80 overflow-hidden shadow-sm flex flex-col">
        <div class="aspect-[16/10] w-full object-cover relative bg-gray-200 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1615811361523-6bd03d7748e7?auto=format&fit=crop&w=800&q=80" alt="Distribusi Komoditas Adil" class="w-full h-full object-cover" loading="lazy">
            <div class="absolute top-3.5 left-3.5 px-2.5 py-1 rounded bg-black/40 backdrop-blur-sm text-white text-[11px] font-medium tracking-wide">
                03 / Rantai Pasok
            </div>
        </div>
        <div class="p-6 flex flex-col flex-grow justify-between">
            <div>
                <h2 class="text-lg font-bold text-sitani-primary mb-2.5">Distribusi Komoditas Adil</h2>
                <p class="text-sm text-sitani-text-muted leading-relaxed mb-6">
                    Penyaluran langsung komoditas pertanian unggulan desa ke jejaring konsumen etis di perkotaan.
                </p>
            </div>
            <a href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-sitani-primary hover:text-sitani-mid transition-colors mt-auto">
                Pasar Berkelanjutan &rarr;
            </a>
        </div>
    </div>
</div>
@endsection
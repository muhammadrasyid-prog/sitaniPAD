@extends('layouts.app', ['title' => 'Beranda - SITANI'])

@section('content')
<div class="flex flex-col items-center justify-center text-center py-20 md:py-28 min-h-[55vh]">
    <!-- Eyebrow Pill -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sitani-card-subtle text-sitani-text-muted text-xs font-semibold uppercase tracking-wider mb-6">
        <span class="w-2 h-2 rounded-full bg-sitani-mid"></span>
        INISIATIF PETANI BERDAULAT
    </div>

    <!-- Hero Headline -->
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-sitani-primary tracking-tight leading-tight max-w-3xl mb-6">
        Mengelola Hasil Bumi untuk Kesejahteraan Bersama
    </h1>

    <!-- Sub-headline Description -->
    <p class="text-base md:text-lg text-sitani-text-muted max-w-xl mb-10 leading-relaxed">
        Yayasan pedesaan independen yang mendampingi petani lokal dalam pengelolaan hasil panen berkelanjutan dan berkeadilan.
    </p>

    <!-- Primary CTA Button -->
    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-lg bg-sitani-primary hover:bg-sitani-primary-hover text-white text-sm font-semibold transition-all duration-150 shadow-sm">
        Lihat Kegiatan Kami
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Trust Subtext -->
    <p class="mt-12 text-xs text-sitani-text-light flex items-center justify-center gap-2">
        &bull; Bersama Petani Lokal &bull; Kesejahteraan Bersama &bull;
    </p>
</div>
@endsection
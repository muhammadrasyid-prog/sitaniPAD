@extends('layouts.app', ['title' => 'Tentang - SITANI'])

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header Section -->
    <div class="mb-10">
        <div class="flex items-center gap-2 text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-2">
            <span class="w-2 h-2 rounded-full bg-sitani-brown-muted"></span>
            MENGENAL YAYASAN
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-sitani-primary tracking-tight">
            Tentang SITANI
        </h1>
    </div>

    <!-- Card 1 - Sejarah Singkat -->
    <div class="bg-sitani-card rounded-2xl p-8 md:p-10 border border-sitani-border/80 shadow-sm mb-6">
        <h2 class="text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-3">SEJARAH SINGKAT</h2>
        <p class="text-sitani-text-main text-base md:text-lg leading-relaxed">
            Didirikan pada tahun 2018 di pelosok Jawa Barat, Yayasan SITANI bermula dari perkumpulan petani kecil yang berikhtiar memutus rantai distribusi yang merugikan produsen pangan. Dengan semangat gotong royong dan kemandirian desa, SITANI kini mengelola program pendampingan budidaya dan tata niaga hasil bumi untuk komunitas tani setempat.
        </p>
    </div>

    <!-- Card 2 - Visi & Misi -->
    <div class="bg-sitani-card-subtle/50 rounded-2xl p-8 md:p-10 border border-sitani-border/60 shadow-sm">
        <h2 class="text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-3">ARAH & KOMITMEN</h2>
        <p class="text-sitani-text-main text-base md:text-lg leading-relaxed">
            <strong>Visi & Misi:</strong> Mewujudkan ekosistem pedesaan yang berdaulat pangan dan sejahtera secara kolektif, dengan misi memperkuat kapasitas budidaya organik, membuka akses pasar langsung yang adil, serta memastikan tata kelola sumber daya desa yang terbuka dan dapat dipertanggungjawabkan kepada seluruh warga.
        </p>
    </div>
</div>
@endsection
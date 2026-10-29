@extends('layouts.app', ['title' => 'Kontak - SITANI'])

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
    <!-- Kolom Kiri -->
    <div class="lg:col-span-5">
        <div class="flex items-center gap-2 text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-2">
            <span class="w-2 h-2 rounded-full bg-sitani-brown-muted"></span>
            INFORMASI TERBUKA
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-sitani-primary tracking-tight mb-4">
            Kontak Yayasan
        </h1>
        <p class="text-base text-sitani-text-muted leading-relaxed">
            Ruang silaturahmi, koordinasi tani, dan keterbukaan informasi publik Yayasan SITANI untuk masyarakat adat, mitra tani, dan pemerhati pangan lokal.
        </p>
    </div>

    <!-- Kolom Kanan -->
    <div class="lg:col-span-7">
        <div class="bg-sitani-card rounded-2xl p-8 md:p-10 border border-sitani-border/80 shadow-sm flex flex-col gap-8">
            
            <!-- Item 1: Kantor Pusat -->
            <div>
                <h2 class="text-xs font-bold text-sitani-brown-muted uppercase tracking-wider mb-1">KANTOR PUSAT</h2>
                <h3 class="text-2xl font-bold text-sitani-primary mb-4">Sekretariat & Balai Komunitas</h3>
                <div class="text-xs font-semibold text-sitani-text-light mb-1 uppercase tracking-wide">Alamat Fisik</div>
                <p class="text-base text-sitani-text-main font-medium leading-relaxed max-w-lg">
                    Jl. Lapang Desa No. 14, RT 02 / RW 04, Desa Sukatani, Kec. Cilawu, Kabupaten Garut, Jawa Barat 44181
                </p>
            </div>

            <!-- Item 2: Kontak Langsung -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-sitani-border/60">
                <!-- WhatsApp / Telepon -->
                <div>
                    <div class="text-xs font-semibold text-sitani-text-light uppercase tracking-wide mb-1">WhatsApp / Telepon Layanan</div>
                    <a href="tel:+6282134567890" class="text-lg font-bold text-sitani-text-main block hover:text-sitani-primary">
                        +62 821-3456-7890
                    </a>
                    <div class="text-xs text-sitani-text-muted mt-1">Senin - Sabtu, 08.00 - 16.00 WIB</div>
                </div>

                <!-- Email / Surel -->
                <div>
                    <div class="text-xs font-semibold text-sitani-text-light uppercase tracking-wide mb-1">Surat Elektronik (Surel)</div>
                    <a href="mailto:kontak@sitani.id" class="text-lg font-bold text-sitani-primary block hover:underline">
                        kontak@sitani.id
                    </a>
                    <div class="text-xs text-sitani-text-muted mt-1">Respon korespondensi maksimal 2 hari kerja</div>
                </div>
            </div>

            <!-- Item 3: Info Box Kunjungan -->
            <div class="p-4 rounded-xl bg-sitani-card-subtle flex items-start gap-3.5 border-l-4 border-sitani-brown-muted">
                <svg class="w-5 h-5 text-sitani-brown-muted mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-xs md:text-sm text-sitani-text-muted leading-relaxed">
                    Untuk kunjungan lapangan, studi banding kelompok tani, atau penyerahan sampel gabah dan tanah, mohon mengonfirmasi sekretariat terlebih dahulu melalui nomor WhatsApp di atas demi kesiapan tim pendamping.
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
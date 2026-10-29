<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PenjualanPanen;
use App\Models\PerawatanLahan;
use App\Models\KepentinganUmum;
use App\Models\PupukMasuk;
use App\Models\PupukTerpakai;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = User::first()->id;

        // Dummy Penjualan Panen
        PenjualanPanen::insert([
            [
                'jenis_tanaman' => 'Padi',
                'tanggal_jual' => Carbon::now()->subDays(10),
                'kuantitas' => 500,
                'satuan' => 'kg',
                'harga_satuan' => 6000,
                'total_harga' => 3000000,
                'pembeli' => 'Pak Budi Tengkulak',
                'bukti_foto' => 'evidence/penjualan-panen/dummy1.jpg',
                'keterangan' => 'Panen musim gadu',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_tanaman' => 'Jagung',
                'tanggal_jual' => Carbon::now()->subDays(5),
                'kuantitas' => 2,
                'satuan' => 'ton',
                'harga_satuan' => 4500000,
                'total_harga' => 9000000,
                'pembeli' => 'KUD Desa',
                'bukti_foto' => 'evidence/penjualan-panen/dummy2.jpg',
                'keterangan' => 'Kualitas super',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Dummy Perawatan Lahan
        PerawatanLahan::insert([
            [
                'tanggal' => Carbon::now()->subDays(15),
                'kategori_biaya' => 'Tenaga Kerja',
                'deskripsi' => 'Gaji 3 buruh untuk matun (membersihkan rumput)',
                'biaya' => 450000,
                'bukti_foto' => 'evidence/perawatan-lahan/dummy1.jpg',
                'keterangan' => '',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now()->subDays(2),
                'kategori_biaya' => 'Sewa Alat',
                'deskripsi' => 'Sewa traktor untuk bajak lahan utara',
                'biaya' => 800000,
                'bukti_foto' => 'evidence/perawatan-lahan/dummy2.jpg',
                'keterangan' => 'Pembayaran lunas',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Dummy Kepentingan Umum (Tampil di Landing)
        KepentinganUmum::insert([
            [
                'tanggal' => Carbon::now()->subMonths(1),
                'kategori_kegiatan' => 'Infrastruktur Desa',
                'deskripsi' => 'Sumbangan material untuk perbaikan jalan desa RT 02',
                'jumlah' => 1500000,
                'bukti_foto' => json_encode(['evidence/kepentingan-umum/dummy1.jpg', 'evidence/kepentingan-umum/dummy2.jpg']),
                'tampil_di_landing' => true,
                'keterangan' => 'Diserahkan ke Kepala Desa',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now()->subWeeks(2),
                'kategori_kegiatan' => 'Pendidikan',
                'deskripsi' => 'Santunan peralatan sekolah untuk anak yatim piatu yayasan',
                'jumlah' => 2000000,
                'bukti_foto' => json_encode(['evidence/kepentingan-umum/dummy3.jpg']),
                'tampil_di_landing' => true,
                'keterangan' => '',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Dummy Pupuk Masuk
        PupukMasuk::insert([
            [
                'tanggal' => Carbon::now()->subDays(20),
                'nama_pupuk' => 'Kotoran Sapi',
                'satuan' => 'Karung',
                'kuantitas' => 50,
                'harga_satuan' => 15000,
                'total_harga' => 750000,
                'supplier' => 'Peternakan H. Samsul',
                'bukti_foto' => 'evidence/pupuk-masuk/dummy1.jpg',
                'keterangan' => '',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => Carbon::now()->subDays(12),
                'nama_pupuk' => 'Kotoran Kambing',
                'satuan' => 'Truk Pick-up',
                'kuantitas' => 2,
                'harga_satuan' => 300000,
                'total_harga' => 600000,
                'supplier' => 'Kandang Komunal Desa',
                'bukti_foto' => 'evidence/pupuk-masuk/dummy2.jpg',
                'keterangan' => '',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Dummy Pupuk Terpakai
        PupukTerpakai::insert([
            [
                'tanggal_pakai' => Carbon::now()->subDays(18),
                'nama_pupuk' => 'Kotoran Sapi',
                'satuan' => 'Karung',
                'kuantitas' => 20,
                'lahan_blok' => 'Blok Utara',
                'tujuan_aplikasi' => 'Pemupukan dasar persiapan tanam',
                'bukti_foto' => 'evidence/pupuk-terpakai/dummy1.jpg',
                'keterangan' => '',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pakai' => Carbon::now()->subDays(10),
                'nama_pupuk' => 'Kotoran Kambing',
                'satuan' => 'Truk Pick-up',
                'kuantitas' => 1,
                'lahan_blok' => 'Blok Selatan',
                'tujuan_aplikasi' => 'Pemupukan susulan jagung',
                'bukti_foto' => 'evidence/pupuk-terpakai/dummy2.jpg',
                'keterangan' => '',
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

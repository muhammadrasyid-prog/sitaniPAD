# 01: Setup Database Migrations & Models

**What to build:** Semua tabel database terbuat dengan schema yang benar dan Eloquent models tersedia, sehingga seluruh layer aplikasi di atas (Filament Resources, halaman publik, export) punya fondasi data yang siap dipakai.

**Blocked by:** None (dapat mulai segera)

**Status:** completed

- [x] Migration `users` diperbarui: tambah kolom `is_super_admin` (boolean, default `false`)
- [x] Migration `master_pupuk`: kolom `id`, `kode_pupuk` (varchar, unique), `nama_pupuk` (varchar), `jenis_kandungan` (varchar, nullable), `satuan` (varchar), `timestamps`
- [x] Migration `penjualan_panen`: kolom `id`, `jenis_tanaman`, `tanggal_tanam`, `tanggal_jual`, `kuantitas` (decimal), `satuan`, `harga_satuan` (decimal), `total_harga` (decimal), `pembeli` (varchar, nullable), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (FK → `users.id`, restrictOnDelete), `timestamps`
- [x] Migration `perawatan_lahan`: kolom `id`, `tanggal`, `deskripsi` (text), `kategori_biaya` (varchar, nullable), `biaya` (decimal), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (FK → `users.id`, restrictOnDelete), `timestamps`
- [x] Migration `kepentingan_umum`: kolom `id`, `tanggal`, `kategori_kegiatan` (varchar), `deskripsi` (text), `jumlah` (decimal), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (FK → `users.id`, restrictOnDelete), `timestamps`
- [x] Migration `pupuk_masuk`: kolom `id`, `tanggal`, `pupuk_id` (FK → `master_pupuk.id`), `kuantitas` (decimal), `harga_satuan` (decimal), `total_harga` (decimal), `supplier` (varchar, nullable), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (FK → `users.id`, restrictOnDelete), `timestamps`
- [x] Migration `pupuk_terpakai`: kolom `id`, `tanggal_pakai`, `pupuk_id` (FK → `master_pupuk.id`), `kuantitas` (decimal), `lahan_blok` (varchar, nullable), `tujuan_aplikasi` (varchar, nullable), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (FK → `users.id`, restrictOnDelete), `timestamps`
- [x] Eloquent model `User` diperbarui: tambah `is_super_admin` ke `$fillable`, tambah relasi `hasMany` ke semua tabel transaksi
- [x] Eloquent model `MasterPupuk` dibuat: `$fillable` lengkap, relasi `hasMany` ke `PupukMasuk` dan `PupukTerpakai`
- [x] Eloquent model `PenjualanPanen`, `PerawatanLahan`, `KepentinganUmum`, `PupukMasuk`, `PupukTerpakai` dibuat: `$fillable` lengkap, relasi `belongsTo` ke `User` (via `user_id`) dan ke `MasterPupuk` (via `pupuk_id`) di mana relevan
- [x] `php artisan migrate` berjalan bersih tanpa error
- [x] Database seeder awal: satu akun Super Admin (`is_super_admin = true`) untuk Pak Umar tersedia via `DatabaseSeeder`

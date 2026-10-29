# 03: Modul Master Pupuk (CRUD Modal)

**What to build:** Admin bisa mengelola daftar jenis pupuk melalui panel Filament — tambah, lihat, edit, dan hapus entri master pupuk. Tabel master ini menjadi sumber dropdown di modul Pupuk Masuk dan Pupuk Terpakai.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth

**Status:** completed

- [x] Filament Resource `MasterPupukResource` tersedia di navigasi grup "Pupuk"
- [x] Tabel list menampilkan kolom: kode pupuk, nama pupuk, jenis kandungan, satuan; dengan `searchable()` pada nama pupuk dan kode pupuk
- [x] Tombol Create membuka modal form dengan field: `kode_pupuk` (required, unique), `nama_pupuk` (required), `jenis_kandungan` (nullable), `satuan` (required)
- [x] Edit record membuka modal form yang sama dengan data terisi
- [x] Hapus record menampilkan dialog konfirmasi terlebih dahulu
- [x] Hapus ditolak dengan pesan error yang jelas jika pupuk masih direferensi oleh transaksi di `pupuk_masuk` atau `pupuk_terpakai` (FK `restrictOnDelete` di database, ditangkap sebagai exception dan ditampilkan sebagai notifikasi Filament)
- [x] Notifikasi sukses muncul setelah create, edit, dan hapus berhasil
- [x] Semua label form dan pesan dalam Bahasa Indonesia

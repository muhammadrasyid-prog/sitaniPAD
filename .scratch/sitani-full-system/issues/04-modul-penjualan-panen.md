# 04: Modul Penjualan Hasil Panen (CRUD Modal + Upload Bukti Foto)

**What to build:** Admin bisa mencatat, menelusuri, mengedit, dan menghapus transaksi penjualan hasil panen lengkap dengan bukti foto. Total harga dihitung otomatis. Audit trail `user_id` terisi otomatis dari sesi admin yang sedang login.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth

**Status:** completed

- [x] Filament Resource `PenjualanPanenResource` tersedia di navigasi grup "Keuangan"
- [x] Tabel list menampilkan kolom: jenis tanaman, tanggal jual, kuantitas + satuan, harga satuan, total harga, pembeli, nama admin (dari relasi `user`); dengan `searchable()` pada jenis tanaman dan pembeli
- [x] Filter tabel: filter by tanggal jual (date range), filter by jenis tanaman — menggunakan `Filament\Tables\Filters` bawaan
- [x] Tombol Create membuka modal form dengan field: `jenis_tanaman` (required), `tanggal_tanam` (date, required), `tanggal_jual` (date, required), `kuantitas` (decimal, required), `satuan` (required), `harga_satuan` (decimal, required), `total_harga` (dihitung otomatis, read-only atau via reactive field), `pembeli` (nullable), `bukti_foto` (FileUpload, required, accept image/*), `keterangan` (nullable)
- [x] Edit record membuka modal form yang sama dengan data terisi; foto lama tampil dan bisa diganti
- [x] `user_id` terisi otomatis dari `auth()->user()->id` saat create via Eloquent `creating` event — tidak tampil sebagai field input
- [x] Hapus record menampilkan dialog konfirmasi; file foto lama ikut dihapus dari storage
- [x] Foto bukti dapat dilihat langsung dari baris tabel (thumbnail atau ikon klik-untuk-preview)
- [x] Notifikasi sukses/gagal muncul setiap aksi CRUD
- [x] Semua label form dan pesan dalam Bahasa Indonesia

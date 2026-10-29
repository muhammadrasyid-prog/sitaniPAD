# 07: Modul Pupuk Masuk (CRUD Modal + Dropdown Master Pupuk)

**What to build:** Admin bisa mencatat, menelusuri, mengedit, dan menghapus penerimaan/pembelian pupuk. Jenis pupuk dipilih dari dropdown yang mengacu ke `master_pupuk`. Nama supplier bersifat teks bebas (bisa toko maupun perorangan/peternak). Bukti foto wajib dilampirkan.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth, 03 — Modul Master Pupuk

**Status:** completed

- [ ] Filament Resource `PupukMasukResource` tersedia di navigasi grup "Pupuk"
- [ ] Tabel list menampilkan kolom: tanggal, nama pupuk (dari relasi `masterPupuk`), kuantitas + satuan pupuk, harga satuan, total harga, supplier, nama admin; dengan `searchable()` pada nama pupuk dan supplier
- [ ] Filter tabel: filter by tanggal (date range), filter by jenis pupuk (select dari `master_pupuk`) — menggunakan `Filament\Tables\Filters` bawaan
- [ ] Tombol Create membuka modal form dengan field: `tanggal` (date, required), `pupuk_id` (Select dari `master_pupuk.nama_pupuk`, required), `kuantitas` (decimal, required), `harga_satuan` (decimal, required), `total_harga` (dihitung otomatis, read-only), `supplier` (varchar, nullable), `bukti_foto` (FileUpload, required, accept image/*), `keterangan` (nullable)
- [ ] Edit record membuka modal form yang sama dengan data terisi; foto lama tampil dan bisa diganti
- [ ] `user_id` terisi otomatis dari `auth()->user()->id` saat create via Eloquent `creating` event
- [ ] Hapus record menampilkan dialog konfirmasi; file foto lama ikut dihapus dari storage
- [ ] Foto bukti dapat dilihat langsung dari baris tabel
- [ ] Notifikasi sukses/gagal muncul setiap aksi CRUD
- [ ] Semua label form dan pesan dalam Bahasa Indonesia

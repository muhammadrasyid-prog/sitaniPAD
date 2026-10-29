# 08: Modul Pupuk Terpakai (CRUD Modal + Dropdown Master Pupuk)

**What to build:** Admin bisa mencatat, menelusuri, mengedit, dan menghapus penggunaan pupuk di lahan. Jenis pupuk dipilih dari dropdown `master_pupuk`. Lahan/blok dan tujuan aplikasi bersifat opsional. Bukti foto wajib dilampirkan.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth, 03 — Modul Master Pupuk

**Status:** completed

- [ ] Filament Resource `PupukTerpakaiResource` tersedia di navigasi grup "Pupuk"
- [ ] Tabel list menampilkan kolom: tanggal pakai, nama pupuk (dari relasi `masterPupuk`), kuantitas + satuan pupuk, lahan/blok, tujuan aplikasi, nama admin; dengan `searchable()` pada nama pupuk dan lahan/blok
- [ ] Filter tabel: filter by tanggal pakai (date range), filter by jenis pupuk (select dari `master_pupuk`) — menggunakan `Filament\Tables\Filters` bawaan
- [ ] Tombol Create membuka modal form dengan field: `tanggal_pakai` (date, required), `pupuk_id` (Select dari `master_pupuk.nama_pupuk`, required), `kuantitas` (decimal, required), `lahan_blok` (varchar, nullable), `tujuan_aplikasi` (varchar, nullable), `bukti_foto` (FileUpload, required, accept image/*), `keterangan` (nullable)
- [ ] Edit record membuka modal form yang sama dengan data terisi; foto lama tampil dan bisa diganti
- [ ] `user_id` terisi otomatis dari `auth()->user()->id` saat create via Eloquent `creating` event
- [ ] Hapus record menampilkan dialog konfirmasi; file foto lama ikut dihapus dari storage
- [ ] Foto bukti dapat dilihat langsung dari baris tabel
- [ ] Notifikasi sukses/gagal muncul setiap aksi CRUD
- [ ] Semua label form dan pesan dalam Bahasa Indonesia

# 05: Modul Perawatan Lahan (CRUD Modal + Upload Bukti Foto)

**What to build:** Admin bisa mencatat, menelusuri, mengedit, dan menghapus pengeluaran perawatan lahan beserta bukti foto. Kategori biaya diisi sebagai teks bebas. Audit trail `user_id` terisi otomatis.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth

**Status:** completed

- [x] Filament Resource `PerawatanLahanResource` tersedia di navigasi grup "Keuangan"
- [x] Tabel list menampilkan kolom: tanggal, deskripsi (truncated), kategori biaya, biaya, nama admin; dengan `searchable()` pada deskripsi dan kategori biaya
- [x] Filter tabel: filter by tanggal (date range), filter by kategori biaya — menggunakan `Filament\Tables\Filters` bawaan
- [x] Tombol Create membuka modal form dengan field: `tanggal` (date, required), `deskripsi` (textarea, required), `kategori_biaya` (varchar, nullable — teks bebas, bukan dropdown), `biaya` (decimal, required), `bukti_foto` (FileUpload, required, accept image/*), `keterangan` (nullable)
- [x] Edit record membuka modal form yang sama dengan data terisi; foto lama tampil dan bisa diganti
- [x] `user_id` terisi otomatis dari `auth()->user()->id` saat create via Eloquent `creating` event
- [x] Hapus record menampilkan dialog konfirmasi; file foto lama ikut dihapus dari storage
- [x] Foto bukti dapat dilihat langsung dari baris tabel
- [x] Notifikasi sukses/gagal muncul setiap aksi CRUD
- [x] Semua label form dan pesan dalam Bahasa Indonesia

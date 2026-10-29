# 06: Modul Kepentingan Umum (CRUD Modal + Upload Bukti Foto)

**What to build:** Admin bisa mencatat, menelusuri, mengedit, dan menghapus pengeluaran kepentingan umum (dana untuk sekolah, perbaikan jalan, dsb.) beserta bukti foto. Kategori kegiatan diisi sebagai teks bebas. Audit trail `user_id` terisi otomatis.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth

**Status:** completed

- [x] Filament Resource `KepentinganUmumResource` tersedia di navigasi grup "Keuangan"
- [x] Tabel list menampilkan kolom: tanggal, kategori kegiatan, deskripsi (truncated), jumlah, nama admin; dengan `searchable()` pada deskripsi dan kategori kegiatan
- [x] Filter tabel: filter by tanggal (date range), filter by kategori kegiatan — menggunakan `Filament\Tables\Filters` bawaan
- [x] Tombol Create membuka modal form dengan field: `tanggal` (date, required), `kategori_kegiatan` (varchar, required — teks bebas, bukan dropdown), `deskripsi` (textarea, required), `jumlah` (decimal, required), `bukti_foto` (FileUpload, required, accept image/*), `keterangan` (nullable)
- [x] Edit record membuka modal form yang sama dengan data terisi; foto lama tampil dan bisa diganti
- [x] `user_id` terisi otomatis dari `auth()->user()->id` saat create via Eloquent `creating` event
- [x] Hapus record menampilkan dialog konfirmasi; file foto lama ikut dihapus dari storage
- [x] Foto bukti dapat dilihat langsung dari baris tabel
- [x] Notifikasi sukses/gagal muncul setiap aksi CRUD
- [x] Semua label form dan pesan dalam Bahasa Indonesia

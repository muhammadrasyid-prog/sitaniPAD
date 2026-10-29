Status: ready-for-agent

# Spec: SITANI — Sistem Informasi Pengelolaan Lahan Pertanian

## Problem Statement

Yayasan Arrofi'i selama ini mencatat transaksi keuangan dan operasional lahan pertanian secara manual (kertas). Akibatnya:

- Rekap dana penjualan hasil panen, pengeluaran perawatan lahan, dan pengeluaran kepentingan umum sulit ditelusuri.
- Tidak ada transparansi publik atas pengelolaan dana yayasan yang dapat diakses masyarakat tanpa harus bertanya langsung ke pengurus.
- Pencatatan stok dan penggunaan pupuk tidak terstruktur, menyulitkan perencanaan musim tanam.
- Laporan keuangan periodik harus dikerjakan ulang dari catatan manual yang rentan kehilangan data.

Pak Umar Taufiq (pengurus yayasan) beserta ibu-ibu PKK sebagai operator admin membutuhkan sistem digital yang ringan, mudah digunakan tanpa keahlian teknis tinggi, dan mampu menghasilkan laporan yang bisa langsung dibagikan ke masyarakat.

## Solution

Membangun aplikasi web **SITANI** berbasis Laravel 12 + Filament PHP v5 yang terdiri dari dua area utama:

1. **Area Publik (Guest)** — halaman informatif yang bisa diakses siapa saja tanpa login: Home, About, Program, Gallery, Contact, dan halaman Transparansi Dana yang merangkum ringkasan keuangan yayasan.

2. **Area Admin (Authenticated)** — panel Filament dengan 6 modul CRUD:
   - Penjualan Hasil Panen
   - Perawatan Lahan
   - Kepentingan Umum
   - Pupuk Masuk
   - Pupuk Terpakai
   - Kelola User *(hanya Super Admin)*

   Setiap transaksi wajib dilampiri bukti foto (evidence). Admin dapat mengekspor laporan ke Excel/CSV berdasarkan rentang tahun atau tanggal kustom.

   Terdapat dua tingkat admin: **Super Admin** (Pak Umar, ditandai `is_super_admin = true`) yang memiliki akses penuh termasuk Kelola User, dan **Admin Biasa** (ibu-ibu PKK, `is_super_admin = false`) yang hanya mengakses 5 modul transaksi.

## User Stories

### Guest (Masyarakat Umum)

1. Sebagai guest, saya ingin melihat halaman Home berisi informasi ringkas tentang SITANI dan Yayasan Arrofi'i, agar saya mendapat gambaran awal tentang yayasan.
2. Sebagai guest, saya ingin membaca halaman About yang menjelaskan profil dan sejarah Yayasan Arrofi'i, agar saya memahami latar belakang yayasan.
3. Sebagai guest, saya ingin melihat halaman Program yang merinci program kerja yayasan, agar saya mengetahui kegiatan apa yang dijalankan yayasan.
4. Sebagai guest, saya ingin menelusuri halaman Gallery yang menampilkan foto-foto kegiatan dan sumbangsih yayasan ke masyarakat, agar saya dapat melihat bukti nyata aktivitas yayasan.
5. Sebagai guest, saya ingin mengakses halaman Contact yang menampilkan nomor telepon, alamat, dan cara menghubungi yayasan, agar saya bisa berkorespondensi dengan pengurus.
6. Sebagai guest, saya ingin melihat halaman Transparansi Dana yang menampilkan ringkasan pemasukan (penjualan panen) dan pengeluaran (perawatan lahan + kepentingan umum), agar saya yakin bahwa dana yayasan dikelola dengan baik dan transparan.
7. Sebagai guest, saya ingin ringkasan transparansi dana dapat difilter atau dikelompokkan berdasarkan tahun, agar saya mudah membandingkan kinerja keuangan antar periode.

### Admin (Pak Umar Taufiq & Ibu-ibu PKK)

Ada dua sub-role admin:
- **Super Admin** (`is_super_admin = true`) — hanya Pak Umar. Akses penuh ke semua 6 modul.
- **Admin Biasa** (`is_super_admin = false`) — ibu-ibu PKK. Akses ke 5 modul transaksi; modul Kelola User tidak terlihat dan tidak bisa diakses.

#### Autentikasi

8. Sebagai admin, saya ingin login ke panel admin menggunakan email dan password, agar data operasional terlindungi dari akses publik.
9. Sebagai admin, saya ingin logout dari panel admin dengan mudah, agar sesi saya aman ketika meninggalkan perangkat.
10. Sebagai admin, saya ingin melihat pesan konfirmasi atau error yang jelas saat login gagal, agar saya tahu apakah credential saya salah.

#### Dashboard

11. Sebagai admin, saya ingin melihat dashboard dengan ringkasan total pemasukan penjualan panen, total pengeluaran perawatan lahan, dan total pengeluaran kepentingan umum untuk periode berjalan, agar saya cepat menangkap kondisi keuangan terkini.

#### Modul Penjualan Hasil Panen

12. Sebagai admin, saya ingin melihat daftar semua catatan penjualan hasil panen (dengan fitur search dan filter per kolom), agar saya mudah menemukan transaksi tertentu.
13. Sebagai admin, saya ingin menambah catatan penjualan baru dengan mengisi: jenis tanaman, tanggal tanam, tanggal panen/jual, kuantitas panen, harga satuan, nama pembeli (opsional), dan mengunggah bukti foto, agar setiap transaksi tercatat lengkap.
14. Sebagai admin, saya ingin total harga dihitung otomatis dari kuantitas × harga satuan, agar saya tidak perlu menghitung manual.
15. Sebagai admin, saya ingin mengedit catatan penjualan yang sudah ada beserta foto buktinya, agar data yang salah input bisa diperbaiki.
16. Sebagai admin, saya ingin menghapus catatan penjualan dengan muncul dialog konfirmasi terlebih dahulu, agar saya tidak menghapus data secara tidak sengaja.
17. Sebagai admin, saya ingin mengekspor data penjualan ke format Excel/CSV dengan opsi filter per tahun atau rentang tanggal kustom, agar saya bisa membuat laporan untuk rapat atau arsip.

#### Modul Perawatan Lahan

18. Sebagai admin, saya ingin melihat daftar semua catatan pengeluaran perawatan lahan dengan search dan filter, agar saya mudah menelusuri riwayat pengeluaran.
19. Sebagai admin, saya ingin menambah catatan perawatan lahan dengan mengisi: tanggal, deskripsi kegiatan, biaya (termasuk biaya tenaga pengurus), dan mengunggah bukti foto, agar pengeluaran tercatat dengan evidensi.
20. Sebagai admin, saya ingin mengedit catatan perawatan lahan yang sudah ada, agar koreksi data bisa dilakukan.
21. Sebagai admin, saya ingin menghapus catatan perawatan lahan dengan konfirmasi, agar penghapusan disengaja.
22. Sebagai admin, saya ingin mengekspor data perawatan lahan ke Excel/CSV per tahun atau rentang tanggal kustom.

#### Modul Kepentingan Umum

23. Sebagai admin, saya ingin melihat daftar semua pengeluaran kepentingan umum (misal: dana untuk sekolah, perbaikan jalan) dengan search dan filter.
24. Sebagai admin, saya ingin menambah catatan kepentingan umum dengan mengisi: tanggal, kategori kepentingan, deskripsi, jumlah pengeluaran, dan bukti foto.
25. Sebagai admin, saya ingin mengedit catatan kepentingan umum.
26. Sebagai admin, saya ingin menghapus catatan kepentingan umum dengan konfirmasi.
27. Sebagai admin, saya ingin mengekspor data kepentingan umum ke Excel/CSV per tahun atau rentang tanggal kustom.

#### Modul Pupuk Masuk

28. Sebagai admin, saya ingin melihat daftar semua catatan pupuk masuk (pembelian/penerimaan pupuk) dengan search dan filter.
29. Sebagai admin, saya ingin menambah catatan pupuk masuk dengan memilih jenis pupuk dari dropdown master pupuk, mengisi kuantitas, harga satuan, nama supplier (toko atau perorangan), dan mengunggah bukti foto.
30. Sebagai admin, saya ingin mengedit catatan pupuk masuk.
31. Sebagai admin, saya ingin menghapus catatan pupuk masuk dengan konfirmasi.
32. Sebagai admin, saya ingin mengekspor data pupuk masuk ke Excel/CSV per tahun atau rentang tanggal kustom.

#### Modul Pupuk Terpakai

33. Sebagai admin, saya ingin melihat daftar semua catatan pupuk yang sudah digunakan di lahan, dengan search dan filter.
34. Sebagai admin, saya ingin menambah catatan pupuk terpakai dengan memilih jenis pupuk dari dropdown master pupuk, mengisi kuantitas, lahan/blok, tujuan aplikasi, dan mengunggah bukti foto.
35. Sebagai admin, saya ingin mengedit catatan pupuk terpakai.
36. Sebagai admin, saya ingin menghapus catatan pupuk terpakai dengan konfirmasi.
37. Sebagai admin, saya ingin mengekspor data pupuk terpakai ke Excel/CSV per tahun atau rentang tanggal kustom.

#### Modul Master Pupuk

38. Sebagai admin, saya ingin melihat daftar semua jenis pupuk yang terdaftar (kode, nama, jenis kandungan, satuan).
39. Sebagai admin, saya ingin menambah jenis pupuk baru ke daftar master, agar pupuk tersebut tersedia sebagai pilihan di modul Pupuk Masuk dan Pupuk Terpakai.
40. Sebagai admin, saya ingin mengedit data jenis pupuk (nama, kandungan, satuan).
41. Sebagai admin, saya ingin menghapus jenis pupuk dari master dengan konfirmasi, dengan catatan sistem menolak penghapusan jika pupuk masih direferensi oleh transaksi yang ada.

#### Modul Kelola User *(Super Admin only)*

42. Sebagai super admin, saya ingin melihat daftar semua akun admin yang terdaftar, beserta status apakah mereka super admin atau admin biasa.
43. Sebagai super admin, saya ingin menambah akun admin baru dengan mengisi nama, email, password, dan memilih apakah akun tersebut super admin atau admin biasa, agar pengurus baru bisa diberikan akses sesuai perannya.
44. Sebagai super admin, saya ingin mengedit data akun admin (nama, email, reset password, toggle is_super_admin).
45. Sebagai super admin, saya ingin menghapus akun admin dengan dialog konfirmasi, agar akun lama yang tidak terpakai dapat dinonaktifkan.
46. Sebagai admin biasa, saya tidak ingin melihat menu Kelola User sama sekali di navigasi panel admin, agar tidak ada kebingungan atau celah akses yang tidak disengaja.
47. Sebagai admin biasa, jika saya mencoba mengakses URL `/admin/users` secara langsung, saya ingin diarahkan ke halaman 403 atau redirect, agar proteksi berjalan di level route/policy bukan hanya UI.

#### Fitur Lintas Modul

48. Sebagai admin, saya ingin setiap aksi CRUD (tambah, edit, hapus) menampilkan notifikasi sukses/gagal yang jelas, agar saya tahu apakah operasi berhasil.
49. Sebagai admin, saya ingin setiap aksi hapus selalu meminta konfirmasi modal terlebih dahulu, agar tidak ada data yang terhapus tidak sengaja.
50. Sebagai admin, saya ingin setiap form transaksi mewajibkan upload minimal satu foto bukti, agar setiap catatan memiliki evidensi fisik.
51. Sebagai admin, saya ingin dapat melihat foto bukti yang sudah diunggah langsung dari tabel/detail record, agar saya tidak perlu mengunduh untuk memverifikasi.

## Implementation Decisions

### Arsitektur Umum

- **Framework**: Laravel 12 (PHP 8.2+), Filament PHP v5 sebagai admin panel builder.
- **Database**: MySQL (production). SQLite untuk development/testing.
- **Auth**: Filament built-in authentication (session-based). Tidak menggunakan JWT atau Sanctum.
- **Satu panel Filament** dengan prefix `/admin`. Tidak ada multi-panel.
- Halaman publik menggunakan **Blade templates** murni (bukan Filament/Livewire), di-route secara terpisah di `routes/web.php`.

### Routing

| Prefix | Path | Keterangan |
|---|---|---|
| Public | `/` | Home |
| Public | `/about` | About Yayasan |
| Public | `/program` | Program kerja |
| Public | `/gallery` | Galeri foto |
| Public | `/contact` | Kontak |
| Public | `/transparansi` | Ringkasan dana publik |
| Admin | `/admin/login` | Halaman login Filament |
| Admin | `/admin` | Dashboard |
| Admin | `/admin/penjualan-panen` | Modul Penjualan Hasil Panen |
| Admin | `/admin/perawatan-lahan` | Modul Perawatan Lahan |
| Admin | `/admin/kepentingan-umum` | Modul Kepentingan Umum |
| Admin | `/admin/pupuk-masuk` | Modul Pupuk Masuk |
| Admin | `/admin/pupuk-terpakai` | Modul Pupuk Terpakai |
| Admin | `/admin/master-pupuk` | Modul Master Pupuk |
| Admin | `/admin/users` | Modul Kelola User |

### Schema Database (rancangan awal)

**Tabel `users`** (sudah ada via Laravel default, diperluas untuk Filament):
- `id`, `name`, `email`, `password`, `is_super_admin` (boolean, default `false`), `remember_token`, `timestamps`

> `is_super_admin = true` hanya untuk Pak Umar (satu akun). Tidak ada hierarki lebih dari dua level ini.

**Tabel `master_pupuk`** *(lookup/dropdown untuk jenis pupuk)*:
- `id`, `kode_pupuk` (varchar, unique), `nama_pupuk` (varchar), `jenis_kandungan` (varchar, nullable — misal: Nitrogen, Fosfat, Kalium), `satuan` (varchar — misal: kg, liter), `timestamps`

> Tabel ini digunakan sebagai sumber dropdown `pupuk_id` di `pupuk_masuk` dan `pupuk_terpakai`. Tidak ada kolom `stok_minimum`.

**Tabel `penjualan_panen`**:
- `id`, `jenis_tanaman` (varchar), `tanggal_tanam` (date), `tanggal_jual` (date), `kuantitas` (decimal), `satuan` (varchar, misal: kg/kwintal/ton), `harga_satuan` (decimal), `total_harga` (decimal, computed/stored), `pembeli` (varchar, nullable), `bukti_foto` (varchar — path), `keterangan` (text, nullable), `user_id` (unsignedBigInteger, FK → `users.id`), `timestamps`

**Tabel `perawatan_lahan`**:
- `id`, `tanggal` (date), `deskripsi` (text), `kategori_biaya` (varchar, nullable — teks bebas, misal: tenaga kerja, bahan, alat), `biaya` (decimal), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (unsignedBigInteger, FK → `users.id`), `timestamps`

**Tabel `kepentingan_umum`**:
- `id`, `tanggal` (date), `kategori_kegiatan` (varchar — teks bebas, misal: pendidikan, infrastruktur), `deskripsi` (text), `jumlah` (decimal), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (unsignedBigInteger, FK → `users.id`), `timestamps`

**Tabel `pupuk_masuk`**:
- `id`, `tanggal` (date), `pupuk_id` (unsignedBigInteger, FK → `master_pupuk.id`), `kuantitas` (decimal), `harga_satuan` (decimal), `total_harga` (decimal), `supplier` (varchar, nullable — bisa nama toko maupun nama warga/peternak), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (unsignedBigInteger, FK → `users.id`), `timestamps`

**Tabel `pupuk_terpakai`**:
- `id`, `tanggal_pakai` (date), `pupuk_id` (unsignedBigInteger, FK → `master_pupuk.id`), `kuantitas` (decimal), `lahan_blok` (varchar, nullable), `tujuan_aplikasi` (varchar, nullable — misal: pemupukan dasar, pemupukan susulan), `bukti_foto` (varchar), `keterangan` (text, nullable), `user_id` (unsignedBigInteger, FK → `users.id`), `timestamps`

> **Audit trail**: kolom `user_id` pada semua tabel transaksi menggunakan `constrained('users')->restrictOnDelete()` — penghapusan user yang masih memiliki transaksi terkait ditolak di level database.
>
> **Kategori sebagai teks bebas**: `kategori_biaya` (perawatan_lahan) dan `kategori_kegiatan` (kepentingan_umum) adalah varchar biasa, bukan foreign key ke tabel master. Admin mengetiknya langsung.
>
> **Foto sebagai kolom langsung**: `bukti_foto` disimpan sebagai path string di kolom masing-masing tabel transaksi, bukan relasi polymorphic atau tabel terpisah.

### Modul Admin (Filament Resources)

Setiap modul diimplementasikan sebagai **Filament Resource** dengan:
- **Form modal**: Create dan Edit menggunakan **modal Filament** (default behavior — `CreateAction` dan `EditAction` dalam modal). Tidak di-override menjadi halaman penuh (`CreateRecord`/`EditRecord` page terpisah).
- **Table**: kolom yang relevan, dengan `searchable()` pada field utama. Filter per kolom (tanggal, jenis pupuk, kategori) menggunakan **`Filament\Tables\Filters`** bawaan (`SelectFilter`, `DateRangeFilter`, dsb.) — tidak menggunakan package filter tambahan.
- **Form field**: field sesuai schema masing-masing tabel, dengan `FileUpload` Filament untuk `bukti_foto` (required, simpan ke `storage/app/public/evidence`). Dropdown `pupuk_id` di modul Pupuk Masuk dan Pupuk Terpakai menggunakan `Select::make('pupuk_id')->relationship('pupuk', 'nama_pupuk')` yang merujuk ke `master_pupuk`.
- **Audit Trail (`user_id`)**: kolom `user_id` diisi otomatis dari `auth()->user()->id` saat record dibuat, via Eloquent `creating` event (observer atau `static::creating()` di model). Tidak ditampilkan sebagai field input di form — admin tidak bisa mengubahnya manual. Boleh ditampilkan sebagai kolom read-only di tabel list.
- **Actions**: `EditAction` (modal), `DeleteAction` (dengan `requiresConfirmation()`), `ExportAction` di header tabel.
- Modul **Kelola User** menggunakan `UserResource` yang mengelola model `User`, tanpa kolom export.
- `UserResource` dilindungi oleh Filament **Authorization** — method `canAccess()` / `canViewAny()` mengembalikan `true` hanya jika `auth()->user()->is_super_admin === true`.
- Navigasi item Kelola User di sidebar otomatis tersembunyi untuk Admin Biasa karena Filament menghormati `canAccess()` pada level Resource.
- Akses langsung via URL `/admin/users` oleh Admin Biasa menghasilkan respons **403 Forbidden** (bukan redirect ke login).

### Export Laporan

- Package: **maatwebsite/excel** (Laravel Excel).
- Setiap Resource punya `Export` class dengan filter `tahun` (integer) atau `tanggal_mulai`–`tanggal_selesai` (date range).
- Format output: `.xlsx` (default) dan `.csv`.
- Export dipanggil melalui Filament `Action` di header tabel, bukan endpoint API terpisah.

### Halaman Publik — Transparansi Dana

- Query ke tabel `penjualan_panen` (total pemasukan), `perawatan_lahan` + `kepentingan_umum` (total pengeluaran).
- Tampilkan ringkasan per tahun: total masuk, total keluar, saldo bersih.
- Tidak menampilkan detail per transaksi (privasi operasional), hanya agregat.

### File Upload

- Driver storage: `public` (symlink `storage/app/public` → `public/storage`).
- Filament `FileUpload` component pada setiap form transaksi, field `bukti_foto`, accept: `image/*`, required.
- File lama dihapus otomatis saat record dihapus (observer atau Filament lifecycle hook).

### UI/UX Admin

- Menggunakan tema default Filament (clean, minimalis) tanpa kustomisasi berlebihan — prioritas fungsional.
- Label navigasi dan form menggunakan **Bahasa Indonesia** seluruhnya.
- Filament `NavigationGroup` untuk mengelompokkan: "Keuangan" (Penjualan, Perawatan, Kepentingan Umum), "Pupuk" (Master Pupuk, Masuk, Terpakai), "Pengaturan" (Kelola User).

### UI/UX Halaman Publik

**Palet warna** (didefinisikan sebagai CSS custom properties via `@theme` di `resources/css/app.css`, Tailwind v4):

| Token | Hex | Penggunaan |
|---|---|---|
| `primary-700` | `#2D5016` | Navbar background, tombol utama, heading utama |
| `secondary-500` | `#A67C52` | Accent, border dekoratif, hover state, ikon |
| `cream` | `#FAF7F2` | Background halaman, card background |

**Prinsip desain:**
- **Keterbacaan utama**: font size cukup besar, contrast ratio memadai antara teks gelap dan background cream.
- **Navigasi sederhana**: navbar horizontal di desktop, hamburger menu di mobile (toggle pure CSS atau minimal JS). Highlight menu aktif dengan warna `primary-700` atau underline `secondary-500`.
- **Tombol**: background `primary-700`, teks putih, hover darken ke `primary-800`. Tombol secondary: border `secondary-500`, teks `secondary-500`, hover fill.
- **Kartu/section**: background `cream` atau putih, border tipis `secondary-200`, border-radius moderat (`rounded-lg`).
- **Animasi**: minimal — hanya `transition-colors` dan `transition-opacity` untuk hover state. Tidak ada scroll animation, parallax, atau library animasi tambahan.
- **Tipografi**: gunakan font sistem (Instrument Sans sudah dikonfigurasi). Heading `font-bold`, body `font-normal`, line-height longgar untuk keterbacaan.
- **Responsif**: mobile-first dengan Tailwind breakpoints (`sm`, `md`, `lg`). Semua halaman publik harus nyaman dibaca di layar HP.
- **Kesan visual**: bersih, terpercaya, bernuansa pertanian/alam — hindari warna neon, gradien berlebihan, atau efek glassmorphism.

## Testing Decisions

### Prinsip Testing

- Uji **perilaku eksternal**, bukan detail implementasi internal.
- Fokus pada: apakah data tersimpan dengan benar? apakah halaman publik merender konten yang tepat? apakah aksi export menghasilkan file?
- Tidak menguji method private, query builder internal, atau struktur Filament component secara unit.

### Seam Utama (satu seam per area)

1. **HTTP/Feature Test** — satu seam untuk seluruh aplikasi. Gunakan `tests/Feature/` dengan Laravel's `RefreshDatabase` trait.
   - Halaman publik: assert response 200, assert konten kunci ada di HTML.
   - Admin CRUD: login sebagai admin, POST/PUT/DELETE ke route Filament, assert database berubah.
   - Export: assert response adalah file download dengan mime type yang benar.
   - Auth guard: assert guest di-redirect ke `/admin/login` saat mengakses `/admin`.

### Modul yang Diuji

- `PenjualanPanenTest` — create, update, delete, export, validasi `bukti_foto` required, validasi field `pembeli` nullable.
- `PerawatanLahanTest` — create, update, delete, export.
- `KepentinganUmumTest` — create, update, delete, export.
- `MasterPupukTest` — create, update, delete; assert delete ditolak jika pupuk masih direferensi transaksi.
- `PupukMasukTest` — create (dengan `pupuk_id` valid), update, delete, export.
- `PupukTerpakaiTest` — create (dengan `pupuk_id` valid), update, delete, export.
- `UserManagementTest` — create, update, delete user; assert Admin Biasa mendapat 403 di `/admin/users`; assert Super Admin bisa akses.
- `PublicPagesTest` — semua 6 route publik mengembalikan 200.
- `TransparansiTest` — halaman transparansi menampilkan angka agregat yang sesuai data seed.
- `AuthTest` — login sukses, login gagal, redirect unauthenticated.

### Prior Art

- Laravel default test di `tests/Feature/` (sudah ada `ExampleTest.php`).
- Gunakan `actingAs()` untuk simulasi admin login di Filament.

## Out of Scope

- **Role/permission hierarki lanjutan**: pembatasan hanya pada satu titik (`is_super_admin` untuk Kelola User). Tidak ada ACL per-record, per-field, atau per-modul lain di luar itu.
- **Notifikasi email/WhatsApp**: tidak ada pengiriman notifikasi otomatis ke stakeholder.
- **API publik/mobile app**: tidak ada REST/GraphQL API. Aplikasi ini web-only.
- **Multi-yayasan / multi-tenant**: sistem dirancang untuk satu yayasan (Arrofi'i) saja.
- **Kalkulasi stok pupuk otomatis**: modul Pupuk Masuk dan Pupuk Terpakai dicatat terpisah; tidak ada saldo stok pupuk yang dihitung otomatis (out of scope v1).
- **Approval workflow**: tidak ada mekanisme review/approve transaksi sebelum tersimpan.
- **Dark mode / custom theming**: gunakan tema default Filament.
- **Internationalization (i18n)**: seluruh antarmuka dalam Bahasa Indonesia saja, tanpa dukungan multi-bahasa.
- **Backup otomatis database**: di luar cakupan aplikasi ini.

## Further Notes

- **Target pengguna admin kurang familiar teknologi** → label form dan pesan error harus dalam Bahasa Indonesia yang jelas dan awam-friendly. Hindari jargon teknis di UI.
- **Filament v5** sudah include: built-in auth, file upload component, table search/filter, delete confirmation modal, dan action notifications — manfaatkan semua fitur bawaan ini, hindari reinventing the wheel.
- **maatwebsite/excel** belum ditambahkan ke `composer.json` (versi saat ini hanya memiliki `filament/filament` dan `laravel/framework`). Perlu `composer require maatwebsite/excel` sebelum fitur export diimplementasikan.
- **Foto bukti** disimpan di storage lokal (`public` disk). Untuk production, pertimbangkan migrasi ke cloud storage (S3/Spaces) — namun ini di luar scope v1.
- **Prioritas pembangunan yang disarankan**: (1) setup Filament + auth, (2) migrasi database, (3) Resource CRUD per modul, (4) fitur export, (5) halaman publik Blade, (6) halaman Transparansi, (7) polish UI + testing.

# Project Overview — SITANI (Sistem Informasi Pengelolaan Lahan Pertanian)

## Konteks
Proyek mata kuliah PAD (Perancangan Aplikasi Digital). Project owner: **Pak Umar Taufiq**, mewakili **Yayasan Arrofi'i**.

## Tujuan Project
Membangun sistem pencatatan digital untuk mengelola:
- Dana penjualan hasil bumi/panen
- Pengeluaran perawatan lahan
- Pengeluaran kepentingan umum (sekolah, perbaikan jalan, dll)

Tujuan utamanya transparansi pengelolaan dana yayasan ke masyarakat, sekaligus mempermudah pencatatan yang selama ini manual.

## User & Role
1. **Admin** — Pak Umar Taufiq dan ibu-ibu PKK (level akses sama, tanpa hierarki)
   - Wajib login
   - Target user kurang familiar teknologi → UI/UX harus disederhanakan
2. **Guest** — masyarakat umum, tanpa login

## Fitur Utama

### Sisi Guest (tanpa login)
- Home
- About (tentang Yayasan Arrofi'i)
- Program (detail program kerja yayasan)
- Gallery (galeri foto kegiatan/sumbangsih ke masyarakat)
- Contact (detail kontak)
- Ringkasan transparansi dana (publik)

### Sisi Admin (setelah login)
6 modul utama:
1. Penjualan Hasil Panen — kuantitas panen, harga dinamis, jenis tanaman, tanggal tanam
2. Perawatan Lahan — pengeluaran perawatan (termasuk biaya tenaga pengurus)
3. Kepentingan Umum — pengeluaran untuk kepentingan masyarakat
4. Pupuk Masuk
5. Pupuk Terpakai
6. Kelola User

Tiap modul (kecuali Kelola User) punya aksi: Lihat, Tambah, Hapus, Edit, Export Data — dengan konfirmasi sebelum aksi CRUD berhasil.
Modul Kelola User: Lihat, Tambah, Hapus, Edit User — juga dengan konfirmasi.

**Fitur pendukung:**
- Setiap pencatatan transaksi wajib disertai bukti foto evidence
- Export laporan format Excel/CSV, bisa per tahun atau custom range tanggal

## Tech Stack
**Backend & Framework:**
- Laravel 11/12 (PHP framework utama)
- Filament PHP (admin panel builder) — untuk 6 modul CRUD (Penjualan Hasil Panen, Perawatan Lahan, Kepentingan Umum, Pupuk Masuk, Pupuk Terpakai, Kelola User), sudah termasuk fitur filter per kolom, search, konfirmasi CRUD, dan export bawaan
- MySQL (database)

**Sisi Guest (Public):**
- Blade templates (bawaan Laravel), terpisah dari area admin Filament
- Routes: Home, About, Program, Gallery, Contact, Ringkasan Transparansi Dana

**Fitur Pendukung:**
- maatwebsite/excel — untuk export laporan format Excel/CSV (per tahun atau custom range tanggal)
- Filament FileUpload — untuk upload bukti foto evidence tiap transaksi
- Filament built-in auth — untuk login Admin (session-based, bukan JWT)

**Struktur Routing Besar:**
Public: `/`, `/about`, `/program`, `/gallery`, `/contact`, `/transparansi`
Admin (prefix `/admin`): `/admin/login`, `/admin` (dashboard), `/admin/penjualan-panen`, `/admin/perawatan-lahan`, `/admin/kepentingan-umum`, `/admin/pupuk-masuk`, `/admin/pupuk-terpakai`, `/admin/users`

## Catatan Desain
- Tidak ada preferensi desain khusus dari client, hanya minta tampilan rapi
- Prioritas: functional dulu, polish belakangan

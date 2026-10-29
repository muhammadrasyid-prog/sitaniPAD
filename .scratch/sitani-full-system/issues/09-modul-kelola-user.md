# 09: Modul Kelola User (Super Admin Only)

**What to build:** Super Admin bisa mengelola akun admin melalui panel Filament — lihat daftar, tambah, edit, dan hapus akun. Admin Biasa sama sekali tidak bisa melihat menu ini dan mendapat 403 jika mencoba akses URL-nya secara langsung.

**Blocked by:** 01 — Setup Database Migrations & Models, 02 — Setup Filament Panel + Auth

**Status:** completed

- [x] Filament Resource `UserResource` tersedia di navigasi grup "Pengaturan" — namun **hanya muncul** untuk user dengan `is_super_admin = true`
- [x] Otorisasi diterapkan di level Resource (`canAccess()` / `canViewAny()` / `canCreate()` / `canEdit()` / `canDelete()`) — bukan hanya di UI. Admin Biasa yang mengakses `/admin/users` secara langsung mendapat respons 403
- [x] Tabel list menampilkan kolom: nama, email, status (Super Admin / Admin Biasa via icon boolean), tanggal dibuat
- [x] Tombol Create membuka modal form dengan field: `name` (required), `email` (required, unique), `password` (required saat create, opsional saat edit — kosong berarti tidak berubah), `is_super_admin` (toggle/checkbox, default false)
- [x] Edit record membuka modal form yang sama; field password kosong secara default (tidak mengubah password jika dibiarkan kosong)
- [x] Hapus record menampilkan dialog konfirmasi
- [x] Notifikasi sukses/gagal muncul setiap aksi CRUD
- [x] Semua label form dan pesan dalam Bahasa Indonesia

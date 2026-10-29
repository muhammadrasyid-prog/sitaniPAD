# 02: Setup Filament Panel + Auth (Login / Logout / Dashboard Stub)

**What to build:** Panel admin Filament aktif di `/admin` dengan autentikasi berfungsi penuh — admin bisa login, melihat dashboard stub, dan logout. Guest yang mencoba mengakses area admin di-redirect ke halaman login. Perbedaan Super Admin dan Admin Biasa sudah dikenali oleh sistem.

**Blocked by:** 01 — Setup Database Migrations & Models

**Status:** completed

- [x] Filament panel terkonfigurasi dengan prefix `/admin` dan auth guard aktif (session-based, bukan JWT)
- [x] Halaman login Filament di `/admin/login` dapat diakses guest dan berfungsi: login sukses masuk dashboard, login gagal tampil pesan error dalam Bahasa Indonesia
- [x] Logout berfungsi dan mengarahkan kembali ke `/admin/login`
- [x] Guest yang mengakses URL admin mana pun di-redirect ke `/admin/login`
- [x] Dashboard menampilkan halaman stub kosong (tanpa widget) — widget keuangan ditambahkan di ticket 10
- [x] Model `User` mengimplementasikan `FilamentUser` interface (`canAccessPanel()` mengembalikan `true` untuk semua user yang ada di tabel `users`)
- [x] Helper atau method yang bisa dicek di seluruh aplikasi untuk membedakan Super Admin (`is_super_admin = true`) vs Admin Biasa — misalnya method `isSuperAdmin()` di model `User`
- [x] NavigationGroup terkonfigurasi: "Keuangan", "Pupuk", "Pengaturan" (kosong dulu, diisi tiap modul)
- [x] Label dan teks antarmuka Filament dalam Bahasa Indonesia (minimal: judul panel, label navigasi, teks tombol login/logout)

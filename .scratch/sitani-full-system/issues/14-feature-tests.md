# 14: Feature Tests

**What to build:** Seluruh acceptance criteria dari spec diverifikasi oleh test suite otomatis — autentikasi, halaman publik, CRUD per modul, otorisasi Super Admin, export laporan, dan halaman transparansi — sehingga tidak ada regresi saat pengembangan berlanjut.

**Blocked by:** 09 — Modul Kelola User, 10 — Dashboard Ringkasan Keuangan, 11 — Export Laporan, 13 — Halaman Transparansi Dana

**Status:** ready-for-agent

- [ ] `AuthTest`: login berhasil dengan credential valid, login gagal dengan credential salah menampilkan pesan error, guest yang akses `/admin` di-redirect ke `/admin/login`
- [ ] `PublicPagesTest`: GET `/`, `/about`, `/program`, `/gallery`, `/contact`, `/transparansi` masing-masing mengembalikan HTTP 200
- [ ] `TransparansiTest`: seed data transaksi, assert halaman `/transparansi` menampilkan angka agregat yang benar (total masuk, keluar, saldo) untuk tiap tahun yang di-seed
- [ ] `PenjualanPanenTest`: create (dengan `bukti_foto` valid) tersimpan ke database; create tanpa `bukti_foto` ditolak dengan validasi; update mengubah data; delete menghapus record dan file foto
- [ ] `PerawatanLahanTest`: create, update, delete berfungsi; create tanpa `bukti_foto` ditolak
- [ ] `KepentinganUmumTest`: create, update, delete berfungsi; create tanpa `bukti_foto` ditolak
- [ ] `MasterPupukTest`: create, update berfungsi; delete berhasil jika pupuk tidak direferensi; delete ditolak (atau menghasilkan error yang ditangkap) jika pupuk masih direferensi transaksi
- [ ] `PupukMasukTest`: create dengan `pupuk_id` valid tersimpan; update dan delete berfungsi; create tanpa `bukti_foto` ditolak
- [ ] `PupukTerpakaiTest`: create dengan `pupuk_id` valid tersimpan; update dan delete berfungsi; create tanpa `bukti_foto` ditolak
- [ ] `UserManagementTest`: Super Admin bisa akses `/admin/users` (HTTP 200); Admin Biasa mendapat HTTP 403; Super Admin bisa create, update, delete user
- [ ] `ExportTest`: request export untuk setiap modul transaksi menghasilkan response dengan Content-Type `application/vnd.openxmlformats-officedocument.spreadsheetml.sheet` atau `text/csv`
- [ ] Semua test menggunakan `RefreshDatabase` trait dan `actingAs()` untuk simulasi login

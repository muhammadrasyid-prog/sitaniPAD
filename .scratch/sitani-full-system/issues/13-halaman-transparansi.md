# 13: Halaman Transparansi Dana (Publik)

**What to build:** Halaman `/transparansi` dapat diakses publik tanpa login dan menampilkan ringkasan agregat keuangan yayasan per tahun — total pemasukan penjualan panen, total pengeluaran perawatan lahan dan kepentingan umum, serta saldo bersih — sehingga masyarakat bisa memverifikasi pengelolaan dana yayasan.

**Blocked by:** 04 — Modul Penjualan Hasil Panen, 05 — Modul Perawatan Lahan, 06 — Modul Kepentingan Umum, 12 — Halaman Publik

**Status:** ready-for-agent

- [ ] Route `/transparansi` terdaftar di `routes/web.php` dan dapat diakses tanpa login
- [ ] Halaman menggunakan layout publik yang sama (navbar, footer, palet warna) dari ticket 12
- [ ] Data yang ditampilkan per tahun:
  - **Total Pemasukan** — sum `total_harga` dari `penjualan_panen`
  - **Total Pengeluaran** — sum `biaya` dari `perawatan_lahan` + sum `jumlah` dari `kepentingan_umum`
  - **Saldo Bersih** — Total Pemasukan − Total Pengeluaran
- [ ] Semua tahun yang memiliki data ditampilkan (bukan hanya tahun berjalan), diurutkan dari terbaru
- [ ] Tampilan per tahun dapat berbentuk tabel atau kartu ringkasan — bukan detail per transaksi
- [ ] Nilai ditampilkan dalam format Rupiah (Rp) dengan pemisah ribuan
- [ ] Halaman responsif mobile-first, teks dalam Bahasa Indonesia

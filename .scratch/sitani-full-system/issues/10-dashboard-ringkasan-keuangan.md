# 10: Dashboard Ringkasan Keuangan

**What to build:** Dashboard admin menampilkan ringkasan keuangan terkini — total pemasukan penjualan panen, total pengeluaran perawatan lahan, dan total pengeluaran kepentingan umum untuk tahun berjalan — sehingga admin langsung mendapat gambaran kondisi keuangan begitu login.

**Blocked by:** 04 — Modul Penjualan Hasil Panen, 05 — Modul Perawatan Lahan, 06 — Modul Kepentingan Umum

**Status:** completed

- [x] Dashboard menampilkan tiga stat widget (Filament `StatsOverviewWidget` atau setara):
  - **Total Pemasukan Panen** — sum `total_harga` dari `penjualan_panen` untuk tahun berjalan
  - **Total Pengeluaran Perawatan** — sum `biaya` dari `perawatan_lahan` untuk tahun berjalan
  - **Total Pengeluaran Kepentingan Umum** — sum `jumlah` dari `kepentingan_umum` untuk tahun berjalan
- [x] Nilai ditampilkan dalam format Rupiah (Rp) dengan pemisah ribuan
- [x] Label widget dalam Bahasa Indonesia
- [x] Widget hanya query data tahun berjalan (berdasarkan `YEAR(tanggal)` atau `YEAR(tanggal_jual)`)

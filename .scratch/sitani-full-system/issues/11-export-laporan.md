# 11: Export Laporan Excel/CSV (Semua Modul Transaksi)

**What to build:** Setiap modul transaksi (Penjualan Panen, Perawatan Lahan, Kepentingan Umum, Pupuk Masuk, Pupuk Terpakai) memiliki tombol Export di header tabel. Admin bisa memilih filter periode (per tahun atau rentang tanggal kustom) lalu mengunduh laporan dalam format `.xlsx` atau `.csv`.

**Blocked by:** 04 — Modul Penjualan Hasil Panen, 05 — Modul Perawatan Lahan, 06 — Modul Kepentingan Umum, 07 — Modul Pupuk Masuk, 08 — Modul Pupuk Terpakai

**Status:** ready-for-agent

- [ ] Package `maatwebsite/excel` (Laravel Excel) di-install via Composer
- [ ] Masing-masing modul transaksi memiliki class Export tersendiri yang menerima parameter filter: `tahun` (integer, opsional) atau `tanggal_mulai`–`tanggal_selesai` (date range, opsional)
- [ ] Tombol Export muncul di header tabel setiap Resource (Filament header action)
- [ ] Klik Export membuka modal/form kecil untuk memilih: format (xlsx / csv), filter periode (pilih tahun dari dropdown tahun tersedia, atau input rentang tanggal kustom)
- [ ] File yang diunduh memiliki nama deskriptif, misal `penjualan-panen-2026.xlsx`
- [ ] Kolom yang diekspor mencakup semua kolom data yang relevan (tidak termasuk path foto internal)
- [ ] Export berfungsi meskipun data kosong (menghasilkan file dengan hanya header kolom)
- [ ] Export dipanggil melalui Filament Action di sisi server — tidak ada endpoint API terpisah

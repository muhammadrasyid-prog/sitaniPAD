# Panduan Kolom Tabel Per Menu Admin SITANI Data apa saja yg ditampilin di tabel

> **Prinsip:** Tabel hanya tampilkan kolom yang **informatif & relevan untuk scanning cepat**. Detail lengkap baru muncul saat klik Edit/Detail.

---

## 1. Penjualan Panen

| Kolom | Tampil di Tabel? | Alasan |
|---|---|---|
| `jenis_tanaman` | ✅ Ya | Identitas utama record |
| `tanggal_jual` | ✅ Ya | Untuk sorting & filter |
| `kuantitas` + `satuan` | ✅ Ya | Digabung jadi "500 kg" |
| `harga_satuan` | ❌ Tidak | Terlalu detail, cukup di form |
| `total_harga` | ✅ Ya | Angka terpenting untuk rekap |
| `pembeli` | ✅ Ya | Identitas transaksi |
| `bukti_foto` | ✅ Ya | Thumbnail kecil sebagai verifikasi cepat |
| `keterangan` | ❌ Tidak | Teks panjang, cukup di form |
| `user_id / created_by` | ✅ Ya | Tampilkan nama admin jika dirasa perlu audit |
| `deleted_by` | ❌ Tidak | Tidak relevan di tabel aktif |
| `created_at` | ❌ Tidak | Sudah terwakili `tanggal_jual` |

---

## 2. Perawatan Lahan

| Kolom | Tampil di Tabel? | Alasan |
|---|---|---|
| `tanggal` | ✅ Ya | Untuk sorting & filter |
| `kategori_biaya` | ✅ Ya | Pengelompokan cepat |
| `deskripsi` | ✅ Ya | Di-truncate max 50 karakter |
| `biaya` | ✅ Ya | Angka terpenting |
| `bukti_foto` | ✅ Ya | Thumbnail verifikasi |
| `keterangan` | ❌ Tidak | Teks panjang, cukup di form |
| `user_id / created_by` | ✅ Ya | Audit trail |
| `deleted_by` | ❌ Tidak | Tidak relevan |
| `created_at` | ❌ Tidak | Sudah terwakili `tanggal` |

---

## 3. Kepentingan Umum

| Kolom | Tampil di Tabel? | Alasan |
|---|---|---|
| `tanggal` | ✅ Ya | Untuk sorting & filter |
| `kategori_kegiatan` | ✅ Ya | Identitas utama |
| `deskripsi` | ✅ Ya | Di-truncate max 50 karakter |
| `jumlah` | ✅ Ya | Angka pengeluaran |
| `bukti_foto` | ✅ Ya | Thumbnail stacked (max 3 foto) |
| `tampil_di_landing` | ✅ Ya | Toggle langsung dari tabel |
| `keterangan` | ❌ Tidak | Teks panjang |
| `user_id / created_by` | ✅ Ya | Audit trail |
| `deleted_by` | ❌ Tidak | Tidak relevan |
| `created_at` | ❌ Tidak | Sudah terwakili `tanggal` |

---

## 4. Pupuk Masuk

| Kolom | Tampil di Tabel? | Alasan |
|---|---|---|
| `tanggal` | ✅ Ya | Untuk sorting & filter |
| `nama_pupuk` | ✅ Ya | Identitas utama |
| `kuantitas` + `satuan` | ✅ Ya | Digabung jadi "50 Karung" |
| `harga_satuan` | ❌ Tidak | Cukup di form |
| `total_harga` | ✅ Ya | Angka terpenting |
| `supplier` | ✅ Ya | Sumber pupuk |
| `bukti_foto` | ✅ Ya | Thumbnail verifikasi |
| `keterangan` | ❌ Tidak | Teks panjang |
| `user_id / created_by` | ✅ Ya | Audit trail |
| `deleted_by` | ❌ Tidak | Tidak relevan |
| `created_at` | ❌ Tidak | Sudah terwakili `tanggal` |

---

## 5. Pupuk Terpakai

| Kolom | Tampil di Tabel? | Alasan |
|---|---|---|
| `tanggal_pakai` | ✅ Ya | Untuk sorting & filter |
| `nama_pupuk` | ✅ Ya | Identitas utama |
| `kuantitas` + `satuan` | ✅ Ya | Digabung jadi "20 Karung" |
| `lahan_blok` | ✅ Ya | Lokasi pemakaian |
| `tujuan_aplikasi` | ✅ Ya | Konteks pemakaian |
| `bukti_foto` | ✅ Ya | Thumbnail verifikasi |
| `keterangan` | ❌ Tidak | Teks panjang |
| `user_id / created_by` | ✅ Ya | Audit trail |
| `deleted_by` | ❌ Tidak | Tidak relevan |
| `created_at` | ❌ Tidak | Sudah terwakili `tanggal_pakai` |

---

## 6. Kelola User

| Kolom | Tampil di Tabel? | Alasan |
|---|---|---|
| `name` | ✅ Ya | Identitas utama |
| `email` | ✅ Ya | Identitas login |
| `is_super_admin` | ✅ Ya | Badge "Super Admin" atau "Admin" |
| `password` | ❌ **Tidak pernah** | Rahasia, tidak boleh ditampilkan |
| `created_at` | ⚠️ Opsional | Kapan akun dibuat |
| `remember_token` | ❌ **Tidak pernah** | Internal Laravel |
| `deleted_at` | ❌ Tidak | Tidak relevan di tabel aktif |

---

## Ringkasan Aturan Umum

| Jenis Kolom | Aturan |
|---|---|
| `password`, `remember_token` | ❌ Tidak pernah tampil di tabel manapun |
| `deleted_by`, `deleted_at` | ❌ Tidak tampil di tabel aktif (mungkin di halaman trash/restore saja) |
| `keterangan` | ❌ Terlalu panjang, cukup di form detail/edit |
| `harga_satuan` | ❌ Cukup tampilkan `total_harga` saja di tabel |
| `user_id` | ❌ Tampilkan nama (`created_by.name`) bukan ID-nya |
| `created_at`, `updated_at` | ❌ Biasanya redundan jika ada kolom tanggal transaksi |
| Foto | ✅ Tampilkan sebagai thumbnail kecil, bukan path string-nya |

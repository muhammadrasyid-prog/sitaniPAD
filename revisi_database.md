# Catatan Revisi ERD & Database SITANI
*(Untuk Backend Developer)*

Berdasarkan keputusan terbaru mengenai arsitektur database SITANI, ada beberapa perubahan pada struktur tabel yang sebelumnya dirancang. Berikut ringkasan revisi yang perlu disesuaikan pada Entity Relationship Diagram (ERD) dan skema Migration Laravel.

## A. Ringkasan Perubahan Tabel

1. **Implementasi Soft Deletes & Kolom Tracking**
   - **Tabel Terdampak**: `master_pupuk`, `penjualan_panen`, `perawatan_lahan`, `kepentingan_umum`, `pupuk_masuk`, `pupuk_terpakai`.
   - **Perubahan**:
     - Tambahkan kolom `deleted_at` (timestamp, nullable) via trait `SoftDeletes`.
     - Tambahkan kolom `deleted_by` (bigint unsigned, nullable, FK ke `users.id`) untuk melacak admin yang melakukan penghapusan *soft delete*.

2. **Revisi Tabel `master_pupuk`**
   - **Dihapus**: Kolom `kode_pupuk` dan `jenis_kandungan`.
   - **Ditambah**: Kolom `keterangan` (text, nullable) untuk catatan bebas admin.
   - **Catatan Tambahan**: Tabel ini difokuskan sebagai referensi/wadah nama pupuk saja, stok dihitung secara *on-the-fly* tanpa perlu kolom `stok_minimum` atau `current_stock` di tabel.

3. **Revisi Tabel `kepentingan_umum` (Fitur Landing Page)**
   - **Diubah**: Kolom `bukti_foto` dari `varchar` menjadi `json` (nullable) untuk mendukung penyimpanan *multiple photo path* dalam satu *record*.
   - **Ditambah**: Kolom `tampil_di_landing` (boolean, default `false`) sebagai *flag* bagi admin untuk memilih kegiatan mana yang dipublikasikan ke Landing Page Guest.

4. **Klarifikasi Kolom yang Tetap/Tidak Berubah (Sesuai Kesepakatan)**
   - Kolom `total_harga` di tabel `penjualan_panen` dan `pupuk_masuk` **TETAP** menggunakan *decimal biasa* (bukan *Generated Column*). Nilainya akan diisi *live/reactive* dari frontend/panel saat `kuantitas` dan `harga_satuan` diinput, namun dibiarkan *editable* manual untuk keperluan pembulatan/diskon.
   - Kolom pengelompokan `kategori_biaya` (`perawatan_lahan`), `kategori_kegiatan` (`kepentingan_umum`), serta `lahan_blok` (`pupuk_terpakai`) **TETAP** teks bebas (`varchar`). Tidak perlu ada relasi *enum* atau tabel master tambahan.
   - Kolom `bukti_foto` pada `penjualan_panen`, `perawatan_lahan`, `pupuk_masuk`, dan `pupuk_terpakai` **TETAP** `varchar` (satu file) dan khusus konsumsi internal (tidak untuk publik).

## B. Panduan Teknis Model & Query (Actionable Items)

- **Casts pada Model `KepentinganUmum`**:
  Pastikan `bukti_foto` di-cast sebagai `array` dan `tampil_di_landing` sebagai `boolean`.
  ```php
  protected $casts = [
      'bukti_foto' => 'array',
      'tampil_di_landing' => 'boolean',
  ];
  ```
- **Kalkulasi Stok Pupuk (Model `MasterPupuk`)**:
  Buat sebuah *Accessor* untuk menghitung stok *real-time* berdasarkan *record* yang tidak di-*soft delete*.
  ```php
  protected function currentStock(): Attribute
  {
      return Attribute::make(
          get: fn () => $this->pupukMasuk()->sum('kuantitas') - $this->pupukTerpakai()->sum('kuantitas'),
      );
  }
  ```
- **Query untuk Halaman Publik (Landing Page)**:
  Tampilkan data hanya untuk *record* dengan flag `tampil_di_landing = true` (baris yang dihapus akan otomatis tersaring oleh *soft deletes*).
  PENTING: Gunakan `.select()` atau API Resource untuk **HANYA** mengambil `tanggal`, `kategori_kegiatan`, `deskripsi`, dan `bukti_foto`. **JANGAN** pernah me-load `jumlah` (biaya), `user_id`, atau `keterangan` internal ke memori saat melayani halaman *guest* publik.

- **Handling Upload File**:
  Pastikan setiap implementasi *file upload* memiliki validasi ukuran dan tipe MIME (`image/jpeg`, `image/png`), serta mengintegrasikan fungsionalitas untuk **menghapus metadata EXIF** (terutama *tag* lokasi/GPS) sebelum file disimpan secara permanen di storage.
# Dokumentasi API SITANI

> **Base URL:** `/api`
> **Auth:** Semua endpoint admin wajib login (session/token)
> **Format:** `application/json`

---

## Daftar Endpoint

| No | Modul | Method | Endpoint |
|---|---|---|---|
| 1 | Penjualan Panen | GET, POST | `/api/penjualan-panen` |
| 1 | Penjualan Panen | GET, PUT, DELETE | `/api/penjualan-panen/{id}` |
| 2 | Perawatan Lahan | GET, POST | `/api/perawatan-lahan` |
| 2 | Perawatan Lahan | GET, PUT, DELETE | `/api/perawatan-lahan/{id}` |
| 3 | Kepentingan Umum | GET, POST | `/api/kepentingan-umum` |
| 3 | Kepentingan Umum | GET, PUT, DELETE | `/api/kepentingan-umum/{id}` |
| 4 | Pupuk Masuk | GET, POST | `/api/pupuk-masuk` |
| 4 | Pupuk Masuk | GET, PUT, DELETE | `/api/pupuk-masuk/{id}` |
| 5 | Pupuk Terpakai | GET, POST | `/api/pupuk-terpakai` |
| 5 | Pupuk Terpakai | GET, PUT, DELETE | `/api/pupuk-terpakai/{id}` |
| 6 | Kelola User | GET, POST | `/api/users` |
| 6 | Kelola User | GET, PUT, DELETE | `/api/users/{id}` |
| 7 | Dashboard | GET | `/api/dashboard` |
| 8 | Kegiatan Publik | GET | `/api/kegiatan-publik` |
| 8 | Transparansi Dana | GET | `/api/transparansi` |

---

## 1. Penjualan Panen

### `GET /api/penjualan-panen`
**Deskripsi:** List semua data penjualan panen.
**Auth:** Required

**Response `200`:**
```json
[
  {
    "id": 1,
    "jenis_tanaman": "Padi",
    "tanggal_jual": "2026-10-08",
    "kuantitas": "500.00",
    "satuan": "kg",
    "harga_satuan": "6000.00",
    "total_harga": "3000000.00",
    "pembeli": "Pak Budi Tengkulak",
    "bukti_foto": "evidence/penjualan-panen/foto.jpg",
    "keterangan": "Panen musim gadu",
    "user_id": 1,
    "created_by": {
      "id": 1,
      "name": "Umar Taufiq"
    },
    "created_at": "2026-10-08T10:00:00Z",
    "updated_at": "2026-10-08T10:00:00Z"
  }
]
```

---

### `POST /api/penjualan-panen`
**Deskripsi:** Tambah data penjualan panen baru.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `jenis_tanaman` | `string` | ✅ | Nama tanaman, misal: Padi, Jagung |
| `tanggal_jual` | `date` (YYYY-MM-DD) | ✅ | Tanggal penjualan/panen |
| `kuantitas` | `numeric` | ✅ | Jumlah dalam satuan yang dipilih |
| `satuan` | `string` | ✅ | Satuan bebas, misal: kg, kwintal, ton |
| `harga_satuan` | `numeric` | ✅ | Harga per satuan (Rupiah) |
| `total_harga` | `numeric` | ✅ | Hasil kuantitas × harga_satuan, bisa diedit manual |
| `pembeli` | `string` | ❌ | Nama pembeli jika ada |
| `bukti_foto` | `file` (image) | ✅ | Foto bukti transaksi, format jpg/png |
| `keterangan` | `string` | ❌ | Catatan tambahan bebas |

**Response `201`:**
```json
{
  "message": "Data penjualan panen berhasil ditambahkan.",
  "data": {
    "id": 1,
    "jenis_tanaman": "Padi",
    "tanggal_jual": "2026-10-08",
    "kuantitas": "500.00",
    "satuan": "kg",
    "harga_satuan": "6000.00",
    "total_harga": "3000000.00",
    "pembeli": "Pak Budi Tengkulak",
    "bukti_foto": "evidence/penjualan-panen/foto.jpg",
    "keterangan": "Panen musim gadu",
    "user_id": 1,
    "created_at": "2026-10-08T10:00:00Z",
    "updated_at": "2026-10-08T10:00:00Z"
  }
}
```

---

### `GET /api/penjualan-panen/{id}`
**Deskripsi:** Detail satu record penjualan panen.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record |

**Response `200`:**
```json
{
  "id": 1,
  "jenis_tanaman": "Padi",
  "tanggal_jual": "2026-10-08",
  "kuantitas": "500.00",
  "satuan": "kg",
  "harga_satuan": "6000.00",
  "total_harga": "3000000.00",
  "pembeli": "Pak Budi Tengkulak",
  "bukti_foto": "evidence/penjualan-panen/foto.jpg",
  "keterangan": "Panen musim gadu",
  "user_id": 1,
  "created_by": {
    "id": 1,
    "name": "Umar Taufiq"
  },
  "created_at": "2026-10-08T10:00:00Z",
  "updated_at": "2026-10-08T10:00:00Z"
}
```

---

### `PUT /api/penjualan-panen/{id}`
**Deskripsi:** Update data penjualan panen.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `jenis_tanaman` | `string` | ❌ | |
| `tanggal_jual` | `date` (YYYY-MM-DD) | ❌ | |
| `kuantitas` | `numeric` | ❌ | |
| `satuan` | `string` | ❌ | |
| `harga_satuan` | `numeric` | ❌ | |
| `total_harga` | `numeric` | ❌ | |
| `pembeli` | `string` | ❌ | |
| `bukti_foto` | `file` (image) | ❌ | Kosongkan jika tidak ganti foto |
| `keterangan` | `string` | ❌ | |

**Response `200`:**
```json
{
  "message": "Data penjualan panen berhasil diperbarui.",
  "data": { "...sama seperti GET /{id}..." }
}
```

---

### `DELETE /api/penjualan-panen/{id}`
**Deskripsi:** Soft delete record penjualan panen. Mengisi `deleted_at` dan `deleted_by` otomatis.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record yang dihapus |

**Response `200`:**
```json
{
  "message": "Data penjualan panen berhasil dihapus."
}
```

---

## 2. Perawatan Lahan

### `GET /api/perawatan-lahan`
**Deskripsi:** List semua data pengeluaran perawatan lahan.
**Auth:** Required

**Response `200`:**
```json
[
  {
    "id": 1,
    "tanggal": "2026-10-01",
    "kategori_biaya": "Tenaga Kerja",
    "deskripsi": "Gaji 3 buruh matun",
    "biaya": "450000.00",
    "bukti_foto": "evidence/perawatan-lahan/foto.jpg",
    "keterangan": null,
    "user_id": 1,
    "created_by": {
      "id": 1,
      "name": "Umar Taufiq"
    },
    "created_at": "2026-10-01T08:00:00Z",
    "updated_at": "2026-10-01T08:00:00Z"
  }
]
```

---

### `POST /api/perawatan-lahan`
**Deskripsi:** Tambah catatan pengeluaran perawatan lahan baru.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal` | `date` (YYYY-MM-DD) | ✅ | Tanggal kegiatan perawatan |
| `kategori_biaya` | `string` | ❌ | Teks bebas, misal: Tenaga Kerja, Sewa Alat |
| `deskripsi` | `string` | ✅ | Penjelasan kegiatan perawatan |
| `biaya` | `numeric` | ✅ | Total biaya (Rupiah) |
| `bukti_foto` | `file` (image) | ✅ | Foto bukti, format jpg/png |
| `keterangan` | `string` | ❌ | Catatan tambahan bebas |

**Response `201`:**
```json
{
  "message": "Data perawatan lahan berhasil ditambahkan.",
  "data": {
    "id": 1,
    "tanggal": "2026-10-01",
    "kategori_biaya": "Tenaga Kerja",
    "deskripsi": "Gaji 3 buruh matun",
    "biaya": "450000.00",
    "bukti_foto": "evidence/perawatan-lahan/foto.jpg",
    "keterangan": null,
    "user_id": 1,
    "created_at": "2026-10-01T08:00:00Z",
    "updated_at": "2026-10-01T08:00:00Z"
  }
}
```

---

### `GET /api/perawatan-lahan/{id}`
**Deskripsi:** Detail satu record perawatan lahan.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record |

**Response `200`:**
```json
{
  "id": 1,
  "tanggal": "2026-10-01",
  "kategori_biaya": "Tenaga Kerja",
  "deskripsi": "Gaji 3 buruh matun",
  "biaya": "450000.00",
  "bukti_foto": "evidence/perawatan-lahan/foto.jpg",
  "keterangan": null,
  "user_id": 1,
  "created_by": {
    "id": 1,
    "name": "Umar Taufiq"
  },
  "created_at": "2026-10-01T08:00:00Z",
  "updated_at": "2026-10-01T08:00:00Z"
}
```

---

### `PUT /api/perawatan-lahan/{id}`
**Deskripsi:** Update data perawatan lahan.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal` | `date` (YYYY-MM-DD) | ❌ | |
| `kategori_biaya` | `string` | ❌ | |
| `deskripsi` | `string` | ❌ | |
| `biaya` | `numeric` | ❌ | |
| `bukti_foto` | `file` (image) | ❌ | Kosongkan jika tidak ganti foto |
| `keterangan` | `string` | ❌ | |

**Response `200`:**
```json
{
  "message": "Data perawatan lahan berhasil diperbarui.",
  "data": { "...sama seperti GET /{id}..." }
}
```

---

### `DELETE /api/perawatan-lahan/{id}`
**Deskripsi:** Soft delete record perawatan lahan.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record yang dihapus |

**Response `200`:**
```json
{
  "message": "Data perawatan lahan berhasil dihapus."
}
```

---

## 3. Kepentingan Umum

### `GET /api/kepentingan-umum`
**Deskripsi:** List semua data pengeluaran kepentingan umum.
**Auth:** Required

**Response `200`:**
```json
[
  {
    "id": 1,
    "tanggal": "2026-09-01",
    "kategori_kegiatan": "Infrastruktur Desa",
    "deskripsi": "Perbaikan jalan desa RT 02",
    "jumlah": "1500000.00",
    "bukti_foto": [
      "evidence/kepentingan-umum/foto1.jpg",
      "evidence/kepentingan-umum/foto2.jpg"
    ],
    "tampil_di_landing": true,
    "keterangan": "Diserahkan ke Kepala Desa",
    "user_id": 1,
    "created_by": {
      "id": 1,
      "name": "Umar Taufiq"
    },
    "created_at": "2026-09-01T09:00:00Z",
    "updated_at": "2026-09-01T09:00:00Z"
  }
]
```

---

### `POST /api/kepentingan-umum`
**Deskripsi:** Tambah catatan pengeluaran kepentingan umum baru.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal` | `date` (YYYY-MM-DD) | ✅ | Tanggal kegiatan |
| `kategori_kegiatan` | `string` | ✅ | Teks bebas, misal: Pendidikan, Infrastruktur |
| `deskripsi` | `string` | ✅ | Penjelasan kegiatan |
| `jumlah` | `numeric` | ✅ | Total pengeluaran (Rupiah) |
| `bukti_foto[]` | `file[]` (image) | ✅ | Bisa lebih dari 1 foto, format jpg/png |
| `tampil_di_landing` | `boolean` | ❌ | Default `false`. Set `true` agar muncul di landing page |
| `keterangan` | `string` | ❌ | Catatan tambahan bebas |

**Response `201`:**
```json
{
  "message": "Data kepentingan umum berhasil ditambahkan.",
  "data": {
    "id": 1,
    "tanggal": "2026-09-01",
    "kategori_kegiatan": "Infrastruktur Desa",
    "deskripsi": "Perbaikan jalan desa RT 02",
    "jumlah": "1500000.00",
    "bukti_foto": [
      "evidence/kepentingan-umum/foto1.jpg",
      "evidence/kepentingan-umum/foto2.jpg"
    ],
    "tampil_di_landing": true,
    "keterangan": "Diserahkan ke Kepala Desa",
    "user_id": 1,
    "created_at": "2026-09-01T09:00:00Z",
    "updated_at": "2026-09-01T09:00:00Z"
  }
}
```

---

### `GET /api/kepentingan-umum/{id}`
**Deskripsi:** Detail satu record kepentingan umum.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record |

**Response `200`:**
```json
{
  "id": 1,
  "tanggal": "2026-09-01",
  "kategori_kegiatan": "Infrastruktur Desa",
  "deskripsi": "Perbaikan jalan desa RT 02",
  "jumlah": "1500000.00",
  "bukti_foto": [
    "evidence/kepentingan-umum/foto1.jpg",
    "evidence/kepentingan-umum/foto2.jpg"
  ],
  "tampil_di_landing": true,
  "keterangan": "Diserahkan ke Kepala Desa",
  "user_id": 1,
  "created_by": {
    "id": 1,
    "name": "Umar Taufiq"
  },
  "created_at": "2026-09-01T09:00:00Z",
  "updated_at": "2026-09-01T09:00:00Z"
}
```

---

### `PUT /api/kepentingan-umum/{id}`
**Deskripsi:** Update data kepentingan umum.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal` | `date` (YYYY-MM-DD) | ❌ | |
| `kategori_kegiatan` | `string` | ❌ | |
| `deskripsi` | `string` | ❌ | |
| `jumlah` | `numeric` | ❌ | |
| `bukti_foto[]` | `file[]` (image) | ❌ | Kosongkan jika tidak ganti foto |
| `tampil_di_landing` | `boolean` | ❌ | |
| `keterangan` | `string` | ❌ | |

**Response `200`:**
```json
{
  "message": "Data kepentingan umum berhasil diperbarui.",
  "data": { "...sama seperti GET /{id}..." }
}
```

---

### `DELETE /api/kepentingan-umum/{id}`
**Deskripsi:** Soft delete record kepentingan umum.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record yang dihapus |

**Response `200`:**
```json
{
  "message": "Data kepentingan umum berhasil dihapus."
}
```

---

## 4. Pupuk Masuk

### `GET /api/pupuk-masuk`
**Deskripsi:** List semua catatan pupuk yang masuk/diterima.
**Auth:** Required

**Response `200`:**
```json
[
  {
    "id": 1,
    "tanggal": "2026-10-06",
    "nama_pupuk": "Kotoran Sapi",
    "satuan": "Karung",
    "kuantitas": "50.00",
    "harga_satuan": "15000.00",
    "total_harga": "750000.00",
    "supplier": "Peternakan H. Samsul",
    "bukti_foto": "evidence/pupuk-masuk/foto.jpg",
    "keterangan": null,
    "user_id": 1,
    "created_by": {
      "id": 1,
      "name": "Umar Taufiq"
    },
    "created_at": "2026-10-06T07:00:00Z",
    "updated_at": "2026-10-06T07:00:00Z"
  }
]
```

---

### `POST /api/pupuk-masuk`
**Deskripsi:** Tambah catatan pupuk masuk baru.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal` | `date` (YYYY-MM-DD) | ✅ | Tanggal pupuk diterima |
| `nama_pupuk` | `string` | ✅ | Nama bebas, misal: Kotoran Sapi, Kotoran Kambing |
| `satuan` | `string` | ✅ | Satuan bebas, misal: Karung, Truk Pick-up |
| `kuantitas` | `numeric` | ✅ | Jumlah dalam satuan yang dipilih |
| `harga_satuan` | `numeric` | ✅ | Harga per satuan (Rupiah) |
| `total_harga` | `numeric` | ✅ | Hasil kuantitas × harga_satuan, bisa diedit manual |
| `supplier` | `string` | ❌ | Nama peternak/toko sumber pupuk |
| `bukti_foto` | `file` (image) | ✅ | Foto bukti, format jpg/png |
| `keterangan` | `string` | ❌ | Catatan tambahan bebas |

**Response `201`:**
```json
{
  "message": "Data pupuk masuk berhasil ditambahkan.",
  "data": {
    "id": 1,
    "tanggal": "2026-10-06",
    "nama_pupuk": "Kotoran Sapi",
    "satuan": "Karung",
    "kuantitas": "50.00",
    "harga_satuan": "15000.00",
    "total_harga": "750000.00",
    "supplier": "Peternakan H. Samsul",
    "bukti_foto": "evidence/pupuk-masuk/foto.jpg",
    "keterangan": null,
    "user_id": 1,
    "created_at": "2026-10-06T07:00:00Z",
    "updated_at": "2026-10-06T07:00:00Z"
  }
}
```

---

### `GET /api/pupuk-masuk/{id}`
**Deskripsi:** Detail satu record pupuk masuk.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record |

**Response `200`:**
```json
{
  "id": 1,
  "tanggal": "2026-10-06",
  "nama_pupuk": "Kotoran Sapi",
  "satuan": "Karung",
  "kuantitas": "50.00",
  "harga_satuan": "15000.00",
  "total_harga": "750000.00",
  "supplier": "Peternakan H. Samsul",
  "bukti_foto": "evidence/pupuk-masuk/foto.jpg",
  "keterangan": null,
  "user_id": 1,
  "created_by": {
    "id": 1,
    "name": "Umar Taufiq"
  },
  "created_at": "2026-10-06T07:00:00Z",
  "updated_at": "2026-10-06T07:00:00Z"
}
```

---

### `PUT /api/pupuk-masuk/{id}`
**Deskripsi:** Update data pupuk masuk.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal` | `date` (YYYY-MM-DD) | ❌ | |
| `nama_pupuk` | `string` | ❌ | |
| `satuan` | `string` | ❌ | |
| `kuantitas` | `numeric` | ❌ | |
| `harga_satuan` | `numeric` | ❌ | |
| `total_harga` | `numeric` | ❌ | |
| `supplier` | `string` | ❌ | |
| `bukti_foto` | `file` (image) | ❌ | Kosongkan jika tidak ganti foto |
| `keterangan` | `string` | ❌ | |

**Response `200`:**
```json
{
  "message": "Data pupuk masuk berhasil diperbarui.",
  "data": { "...sama seperti GET /{id}..." }
}
```

---

### `DELETE /api/pupuk-masuk/{id}`
**Deskripsi:** Soft delete record pupuk masuk.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record yang dihapus |

**Response `200`:**
```json
{
  "message": "Data pupuk masuk berhasil dihapus."
}
```

---

## 5. Pupuk Terpakai

### `GET /api/pupuk-terpakai`
**Deskripsi:** List semua catatan pupuk yang sudah digunakan di lahan.
**Auth:** Required

**Response `200`:**
```json
[
  {
    "id": 1,
    "tanggal_pakai": "2026-10-08",
    "nama_pupuk": "Kotoran Sapi",
    "satuan": "Karung",
    "kuantitas": "20.00",
    "lahan_blok": "Blok Utara",
    "tujuan_aplikasi": "Pemupukan dasar persiapan tanam",
    "bukti_foto": "evidence/pupuk-terpakai/foto.jpg",
    "keterangan": null,
    "user_id": 1,
    "created_by": {
      "id": 1,
      "name": "Umar Taufiq"
    },
    "created_at": "2026-10-08T07:00:00Z",
    "updated_at": "2026-10-08T07:00:00Z"
  }
]
```

---

### `POST /api/pupuk-terpakai`
**Deskripsi:** Tambah catatan pupuk terpakai baru.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal_pakai` | `date` (YYYY-MM-DD) | ✅ | Tanggal pupuk dipakai |
| `nama_pupuk` | `string` | ✅ | Nama bebas, misal: Kotoran Sapi |
| `satuan` | `string` | ✅ | Satuan bebas, misal: Karung, Truk |
| `kuantitas` | `numeric` | ✅ | Jumlah dalam satuan yang dipilih |
| `lahan_blok` | `string` | ❌ | Nama blok/lahan, misal: Blok Utara |
| `tujuan_aplikasi` | `string` | ❌ | Misal: Pemupukan dasar, Pemupukan susulan |
| `bukti_foto` | `file` (image) | ✅ | Foto bukti, format jpg/png |
| `keterangan` | `string` | ❌ | Catatan tambahan bebas |

**Response `201`:**
```json
{
  "message": "Data pupuk terpakai berhasil ditambahkan.",
  "data": {
    "id": 1,
    "tanggal_pakai": "2026-10-08",
    "nama_pupuk": "Kotoran Sapi",
    "satuan": "Karung",
    "kuantitas": "20.00",
    "lahan_blok": "Blok Utara",
    "tujuan_aplikasi": "Pemupukan dasar persiapan tanam",
    "bukti_foto": "evidence/pupuk-terpakai/foto.jpg",
    "keterangan": null,
    "user_id": 1,
    "created_at": "2026-10-08T07:00:00Z",
    "updated_at": "2026-10-08T07:00:00Z"
  }
}
```

---

### `GET /api/pupuk-terpakai/{id}`
**Deskripsi:** Detail satu record pupuk terpakai.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record |

**Response `200`:**
```json
{
  "id": 1,
  "tanggal_pakai": "2026-10-08",
  "nama_pupuk": "Kotoran Sapi",
  "satuan": "Karung",
  "kuantitas": "20.00",
  "lahan_blok": "Blok Utara",
  "tujuan_aplikasi": "Pemupukan dasar persiapan tanam",
  "bukti_foto": "evidence/pupuk-terpakai/foto.jpg",
  "keterangan": null,
  "user_id": 1,
  "created_by": {
    "id": 1,
    "name": "Umar Taufiq"
  },
  "created_at": "2026-10-08T07:00:00Z",
  "updated_at": "2026-10-08T07:00:00Z"
}
```

---

### `PUT /api/pupuk-terpakai/{id}`
**Deskripsi:** Update data pupuk terpakai.
**Auth:** Required
**Content-Type:** `multipart/form-data`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `tanggal_pakai` | `date` (YYYY-MM-DD) | ❌ | |
| `nama_pupuk` | `string` | ❌ | |
| `satuan` | `string` | ❌ | |
| `kuantitas` | `numeric` | ❌ | |
| `lahan_blok` | `string` | ❌ | |
| `tujuan_aplikasi` | `string` | ❌ | |
| `bukti_foto` | `file` (image) | ❌ | Kosongkan jika tidak ganti foto |
| `keterangan` | `string` | ❌ | |

**Response `200`:**
```json
{
  "message": "Data pupuk terpakai berhasil diperbarui.",
  "data": { "...sama seperti GET /{id}..." }
}
```

---

### `DELETE /api/pupuk-terpakai/{id}`
**Deskripsi:** Soft delete record pupuk terpakai.
**Auth:** Required

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID record yang dihapus |

**Response `200`:**
```json
{
  "message": "Data pupuk terpakai berhasil dihapus."
}
```

---

## 6. Kelola User *(Super Admin only)*

### `GET /api/users`
**Deskripsi:** List semua akun admin yang terdaftar.
**Auth:** Required — **hanya Super Admin** (`is_super_admin = true`). Admin biasa mendapat response `403`.

**Response `200`:**
```json
[
  {
    "id": 1,
    "name": "Umar Taufiq",
    "email": "umar@arrofii.id",
    "is_super_admin": true,
    "created_at": "2026-09-15T00:00:00Z"
  },
  {
    "id": 2,
    "name": "Ibu PKK (Admin)",
    "email": "pkk@arrofii.id",
    "is_super_admin": false,
    "created_at": "2026-09-15T00:00:00Z"
  }
]
```

---

### `POST /api/users`
**Deskripsi:** Tambah akun admin baru.
**Auth:** Required — Super Admin only.
**Content-Type:** `application/json`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `name` | `string` | ✅ | Nama lengkap admin |
| `email` | `string` (email) | ✅ | Email unik, digunakan untuk login |
| `password` | `string` | ✅ | Minimal 8 karakter |
| `is_super_admin` | `boolean` | ❌ | Default `false` |

**Response `201`:**
```json
{
  "message": "Akun admin berhasil ditambahkan.",
  "data": {
    "id": 3,
    "name": "Admin Baru",
    "email": "admin.baru@arrofii.id",
    "is_super_admin": false,
    "created_at": "2026-10-18T00:00:00Z"
  }
}
```

---

### `GET /api/users/{id}`
**Deskripsi:** Detail satu akun admin.
**Auth:** Required — Super Admin only.

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID user |

**Response `200`:**
```json
{
  "id": 1,
  "name": "Umar Taufiq",
  "email": "umar@arrofii.id",
  "is_super_admin": true,
  "created_at": "2026-09-15T00:00:00Z"
}
```

---

### `PUT /api/users/{id}`
**Deskripsi:** Update data akun admin.
**Auth:** Required — Super Admin only.
**Content-Type:** `application/json`

| Field | Tipe | Wajib | Keterangan |
|---|---|---|---|
| `name` | `string` | ❌ | |
| `email` | `string` (email) | ❌ | |
| `password` | `string` | ❌ | Kosongkan jika tidak ganti password |
| `is_super_admin` | `boolean` | ❌ | |

**Response `200`:**
```json
{
  "message": "Data akun admin berhasil diperbarui.",
  "data": { "...sama seperti GET /{id}..." }
}
```

---

### `DELETE /api/users/{id}`
**Deskripsi:** Hapus akun admin.
**Auth:** Required — Super Admin only.
**Catatan:** Tidak bisa menghapus akun diri sendiri.

| Param | Tipe | Keterangan |
|---|---|---|
| `id` | `integer` | ID user yang dihapus |

**Response `200`:**
```json
{
  "message": "Akun admin berhasil dihapus."
}
```

**Response `403` (menghapus diri sendiri):**
```json
{
  "message": "Tidak dapat menghapus akun sendiri."
}
```

---

## 7. Dashboard

### `GET /api/dashboard`
**Deskripsi:** Ringkasan keuangan yayasan untuk tahun berjalan.
**Auth:** Required

**Query Params (opsional):**

| Param | Tipe | Contoh | Keterangan |
|---|---|---|---|
| `tahun` | `integer` | `2025` | Filter per tahun, default tahun berjalan |

**Response `200`:**
```json
{
  "tahun": 2026,
  "total_pemasukan": 12000000,
  "total_pengeluaran_perawatan": 1250000,
  "total_pengeluaran_kepentingan": 3500000,
  "total_pengeluaran": 4750000,
  "saldo_bersih": 7250000
}
```

---

## 8. Landing Page (Publik — tanpa auth)

### `GET /api/kegiatan-publik`
**Deskripsi:** List kegiatan kepentingan umum yang dipilih admin untuk ditampilkan di landing page.
**Auth:** Tidak perlu (publik)

**Response `200`:**
```json
[
  {
    "tanggal": "2026-09-01",
    "kategori_kegiatan": "Infrastruktur Desa",
    "deskripsi": "Perbaikan jalan desa RT 02",
    "bukti_foto": [
      "/storage/evidence/kepentingan-umum/foto1.jpg",
      "/storage/evidence/kepentingan-umum/foto2.jpg"
    ]
  }
]
```

**Catatan:** Kolom `jumlah`, `user_id`, `keterangan` tidak dikembalikan demi privasi operasional.

---

### `GET /api/transparansi`
**Deskripsi:** Ringkasan keuangan yayasan per tahun untuk halaman Transparansi Dana.
**Auth:** Tidak perlu (publik)

**Response `200`:**
```json
[
  {
    "tahun": 2026,
    "total_pemasukan": 12000000,
    "total_pengeluaran": 4750000,
    "saldo_bersih": 7250000
  },
  {
    "tahun": 2025,
    "total_pemasukan": 9500000,
    "total_pengeluaran": 7200000,
    "saldo_bersih": 2300000
  }
]
```

**Catatan:** Hanya menampilkan angka agregat per tahun, tidak ada detail per transaksi.

---

## Catatan Umum

| Hal | Penjelasan |
|---|---|
| **Soft Delete** | Semua `DELETE` pada modul transaksi menggunakan soft delete. Data tidak benar-benar terhapus, hanya diisi `deleted_at` dan `deleted_by` otomatis |
| **Upload Foto** | Semua endpoint yang menerima foto menggunakan `multipart/form-data`. Foto disimpan di `storage/app/public/evidence/` |
| **`total_harga`** | Dihitung otomatis di FE dari `kuantitas × harga_satuan`, namun tetap bisa diedit manual untuk pembulatan/nego |
| **Satuan Pupuk** | Teks bebas (Karung, Truk Pick-up, Kg, dll). Tidak ada validasi enum |
| **`bukti_foto` Kepentingan Umum** | Bertipe JSON array karena bisa lebih dari 1 foto. Modul lain bertipe string (1 foto) |
| **Super Admin only** | Endpoint `/api/users` hanya bisa diakses oleh user dengan `is_super_admin = true`. Selain itu mendapat response `403` |

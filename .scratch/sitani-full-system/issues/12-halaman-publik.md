# 12: Halaman Publik (Home, About, Program, Gallery, Contact)

**What to build:** Lima halaman publik Blade dapat diakses siapa saja tanpa login, dengan tampilan bersih dan responsif menggunakan palet warna yayasan (hijau tua, coklat/gold, cream). Navbar responsif dengan hamburger menu di mobile. Semua halaman berbagi layout yang sama.

**Blocked by:** None (dapat mulai segera, paralel dengan ticket lain)

**Status:** ready-for-agent

- [ ] Layout Blade publik (`layouts/public.blade.php`) dibuat dengan:
  - Navbar: background `primary-700` (#2D5016), logo/nama SITANI, link navigasi (Home, About, Program, Gallery, Contact, Transparansi), menu aktif di-highlight
  - Hamburger menu mobile (toggle minimal JS atau pure CSS), responsif
  - Footer sederhana dengan nama yayasan dan kontak singkat
  - Background halaman `cream` (#FAF7F2)
  - Tailwind v4 dengan token warna yang sudah dikonfigurasi di `app.css`
- [ ] Route dan controller/view untuk: `/` (Home), `/about` (About), `/program` (Program), `/gallery` (Gallery), `/contact` (Contact)
- [ ] Halaman **Home**: hero section dengan nama SITANI dan tagline, ringkasan singkat tentang yayasan, CTA ke halaman About atau Transparansi
- [ ] Halaman **About**: profil dan latar belakang Yayasan Arrofi'i
- [ ] Halaman **Program**: daftar atau uraian program kerja yayasan
- [ ] Halaman **Gallery**: grid foto kegiatan yayasan (foto statis/placeholder untuk sekarang — tidak ada CMS upload dari spec)
- [ ] Halaman **Contact**: alamat, nomor telepon, dan informasi kontak yayasan
- [ ] Semua halaman responsif mobile-first (`sm`, `md`, `lg` breakpoints Tailwind)
- [ ] Animasi hanya `transition-colors` pada hover — tidak ada library animasi tambahan
- [ ] Teks/konten menggunakan Bahasa Indonesia

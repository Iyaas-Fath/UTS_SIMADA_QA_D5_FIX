# Software Design Description – SIMADA D5
**Dokumentasi desain mengacu IEEE 1016-2009**

## 1. Identifikasi desain
Nama: SIMADA Dashboard & Reporting (D5). Teknologi: PHP >= 8.1, Laravel 10, Blade, query builder Laravel, MySQL/MariaDB sebagai baseline pengembangan.
## 2. Konteks dan arsitektur
- View: `resources/views/dashboard/index.blade.php`, `resources/views/auth/login.blade.php`.
- Controller: `DashboardController` memvalidasi autentikasi/role, menerapkan filter, mengagregasi data, dan menyediakan ekspor.
- Auth Controller: `LoginController` menangani login/logout menggunakan mekanisme Auth Laravel.
- Data: tabel `opd`, `procurement_packages`, `package_stages`, `documents`, dan `users`.
- Alur: Browser → Route → Middleware Auth → Controller → Query Builder/Database → Blade/CSV → Browser.
## 3. Komponen
### 3.1 DashboardController@index
Menerima filter `tahun`, `opd`, `jenis`, `metode`; membatasi akses; menyiapkan ringkasan, data bulanan, tracking, dan daftar paket.
### 3.2 DashboardController@exportCsv
Menggunakan filter yang sama dan menghasilkan CSV ber-UTF-8 yang dapat dibuka di Excel.
### 3.3 LoginController
Menangani validasi kredensial, regenerasi session saat login, dan invalidasi session saat logout.
## 4. Desain data
- `procurement_packages`: kode/nama paket, OPD, jenis, metode, pagu, nilai kontrak, tahun, status, progres, tanggal kontrak.
- `package_stages`: relasi paket, nama tahap, urutan, tanggal rencana/realisasi, status tahap.
- `documents`: metadata dokumen keluaran dan status TTE.
- `opd`: kode dan nama OPD.
- `users`: akun, role, dan OPD.
## 5. Desain antarmuka
Dashboard memiliki empat filter; empat kartu ringkasan; grafik 12 bulan; tracking progress; tabel paket; tombol ekspor; serta tombol logout. Desain responsif melalui media query.
## 6. Desain keamanan
Route dashboard memakai middleware `auth`. Controller memeriksa role yang diizinkan dan membatasi paket ke OPD user non-admin apabila `opd_id` tersedia. Kredensial disimpan menggunakan hash Laravel. Konfigurasi HTTPS dan hardening server harus dilakukan di deployment.
## 7. Desain QA dan verifikasi
Pengujian otomatis tersedia pada `tests/Feature/DashboardReportingTest.php`. Matriks kasus uji manual tersedia pada `QA_Test_Cases.xlsx`. Jalankan `php artisan test` setelah migration dan seeding.
## 8. Batasan implementasi
Pembuatan dokumen PDF dan XLSX native belum termasuk dalam baseline; ekspor tabel menggunakan CSV. Kolom `documents` disiapkan untuk pengembangan lanjutan sesuai KAK. Perlu validasi ulang kompatibilitas query bulan untuk PostgreSQL sebelum deployment.

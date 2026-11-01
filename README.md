# SIMADA (Sistem Informasi Pengadaan Barang dan Jasa)

SIMADA adalah aplikasi berbasis web yang dikembangkan menggunakan framework **Laravel** untuk mengelola data paket pengadaan barang dan jasa di instansi pemerintahan daerah. Sistem ini dilengkapi dengan manajemen multi-peran (*Admin*, *Petugas*, dan *Masyarakat*), pemantauan progress pengadaan secara real-time, serta fitur pelaporan ekspor data ke format Excel dan PDF.

---

## Fitur Utama
- **Autentikasi & Manajemen Pengguna:** Pengelolaan akun pengguna berbasis peran (*Role-based access control*).
- **Manajemen Paket Pengadaan:** Operasi CRUD (Create, Read, Update, Delete) data paket pengadaan lengkap dengan informasi OPD, pagu, nilai kontrak, status, dan persentase *progress*.
- **Tracking Progress:** Widget pemantauan kemajuan paket pengadaan yang sedang berjalan.
- **Filter & Rekapitulasi:** Penyaringan data berdasarkan Tahun Anggaran, OPD, Jenis Pengadaan, dan Metode.
- **Ekspor Laporan:** Fitur cetak dan unduh laporan pengadaan dalam format Excel dan PDF.

---

## Kebutuhan Sistem
Pastikan komputer/server Anda telah menginstal:
- **PHP** >= 8.1
- **Composer**
- **MySQL / MariaDB**

---

## Cara Instalasi & Menjalankan Proyek

1. Buka terminal pada direktori proyek.
2. Jalankan perintah untuk menginstal dependensi:
   ```bash
   composer install

Generate Application Key:
php artisan key:generate

Jalankan migrasi dan seeder database:
php artisan migrate:fresh --seed

Jalankan server lokal:
php artisan serve

Buka browser dan akses: http://127.0.0.1:8000

Akun Bawaan (Default Login):

Admin: admin@simada.com | Password: admin12
Petugas: petugas@simada.com | Password: petugas123
Masyarakat: user@simada.com | Password: user123
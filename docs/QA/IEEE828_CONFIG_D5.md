# Software Configuration Management Plan – SIMADA D5
**Dokumentasi konfigurasi mengacu IEEE 828**

## 1. Tujuan
Mengidentifikasi item konfigurasi, baseline, perubahan, dan verifikasi untuk modul QA/D5 agar kode, database, tes, dan dokumen konsisten.
## 2. Item konfigurasi
| ID | Item | Lokasi |
|---|---|---|
| CI-01 | Route web | `routes/web.php` |
| CI-02 | Controller dashboard | `app/Http/Controllers/DashboardController.php` |
| CI-03 | Controller autentikasi | `app/Http/Controllers/Auth/LoginController.php` |
| CI-04 | Migration D5 | `database/migrations/2026_10_13_000001_create_simada_reporting_tables.php` |
| CI-05 | Seeder demo | `database/seeders/DatabaseSeeder.php` |
| CI-06 | View dashboard | `resources/views/dashboard/index.blade.php` |
| CI-07 | View login | `resources/views/auth/login.blade.php` |
| CI-08 | Pengujian otomatis | `tests/Feature/DashboardReportingTest.php` |
| CI-09 | Dokumen QA | `docs/QA/` |
| CI-10 | Matriks kasus uji | `docs/QA/QA_Test_Cases.xlsx` |
## 3. Baseline
Baseline awal bernama `SIMADA-D5-QA-1.0.0`, berbasis struktur project Laravel 10 yang terdapat dalam ZIP UTS. Dataset seeder ditandai sebagai data demo.
## 4. Aturan perubahan
Setiap perubahan harus mencatat ID perubahan, alasan, file terdampak, kebutuhan terkait, kasus uji regresi, tanggal, dan status persetujuan. Jangan mengubah konfigurasi environment atau memasukkan kredensial produksi ke version control.
## 5. Prosedur rilis
1. Buat salinan/branch untuk perubahan.
2. Ubah kode dan dokumentasi.
3. Jalankan `php artisan migrate:fresh --seed` hanya pada database pengembangan/test yang aman.
4. Jalankan `php artisan test`.
5. Jalankan kasus uji manual dari spreadsheet.
6. Tinjau diff dan konfigurasi `.env`.
7. Beri tag versi dan simpan ZIP baseline bersama catatan perubahan.
## 6. Catatan keamanan
Ganti kredensial demo sebelum dipakai di lingkungan lain. Jangan mengarsipkan `.env` berisi rahasia. ZIP ini mempertahankan file project asli, sehingga `.env` bawaan dari arsip harus diperiksa dan diganti sebelum penggunaan bersama.

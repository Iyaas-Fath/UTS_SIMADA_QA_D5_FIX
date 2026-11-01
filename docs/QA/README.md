# SIMADA – Modul QA Testing D5

## Tujuan
Menguji modul Dashboard & Reporting pada D5 (Reporting & Document Output Domain), dengan sumber data `procurement_packages`, `package_stages`, dan `documents`. Implementasi mengikuti kebutuhan yang tersedia pada KAK SIMADA, SDD, Requirement Analysis & Design, dan workbook RPL_KAK.

## Ruang lingkup implementasi
- Filter Tahun Anggaran, OPD, Jenis Pengadaan, Metode Pengadaan.
- Kartu Total Paket, Total Pagu, Realisasi Anggaran, persentase realisasi terhadap pagu.
- Grafik Rencana (Pagu) vs Realisasi (Nilai Kontrak) per bulan.
- Tracking Progress dan tabel Paket Pengadaan.
- Ekspor tabel menjadi CSV yang dapat dibuka di Excel.
- Autentikasi dan pembatasan akses role di controller.

## Standar dokumentasi yang diminta
- **IEEE 830-1998 (SRS):** kebutuhan fungsional/nonfungsional serta kriteria penerimaan dirangkum dalam `IEEE830_SRS_D5.md`.
- **IEEE 1016-2009 (SDD):** desain arsitektur, komponen, data, antarmuka, dan desain tes dirangkum dalam `IEEE1016_SDD_D5.md`.
- **IEEE 828 (Configuration Management):** baseline, struktur versi, perubahan, dan identifikasi item konfigurasi dijelaskan di `IEEE828_CONFIG_D5.md`.

Dokumen ini disusun sebagai dokumentasi tugas dengan struktur yang mengacu pada standar tersebut, bukan klaim sertifikasi atau pemenuhan penuh semua klausul standar.

## Cara menjalankan di Windows
1. Ekstrak ZIP.
2. Buka folder `UTS/UTS` di VS Code.
3. Pastikan PHP 8.1+, Composer, dan MySQL/MariaDB tersedia.
4. Salin `.env.example` menjadi `.env`; buat database bernama `simada_qa`.
5. Atur `DB_DATABASE=simada_qa`, `DB_USERNAME`, dan `DB_PASSWORD` di `.env`.
6. Jalankan:
   ```bash
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan serve --host=127.0.0.1 --port=8080
   ```
7. Buka `http://127.0.0.1:8080/login`.
8. Akun demo: `admin@simada.local` / `Admin123!`.
9. Jalankan pengujian otomatis:
   ```bash
   php artisan test
   ```

## Catatan penting
- Dataset seeder hanyalah data demo untuk pengujian, bukan data pengadaan resmi.
- Ekspor CSV dapat dibuka dengan Excel. Pembuatan PDF atau berkas XLSX native belum diimplementasikan pada baseline ini.
- Untuk produksi, ganti kredensial demo, konfigurasi HTTPS, kebijakan role/OPD, dan validasi keamanan sesuai lingkungan Pemkab.

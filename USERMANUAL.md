# SIMADA – UTS Revisi Modul QA Testing D5

Lihat `docs/QA/README.md` untuk petunjuk menjalankan aplikasi dan daftar batasan implementasi.
Akun demo: `admin@simada.local` / `Admin123!`.
URL lokal yang dituju: `http://127.0.0.1:8080`.
Dokumen acuan: IEEE 830-1998 (kebutuhan), IEEE 1016-2009 (desain perangkat lunak), IEEE 828 (manajemen konfigurasi).


---

## 2. User Manual (Panduan Pengguna)

```markdown
# User Manual (Panduan Penggunaan) - SIMADA

Panduan ini berisi langkah-langkah operasional untuk menggunakan aplikasi **SIMADA (Sistem Informasi Pengadaan)** bagi Admin, Petugas, maupun Pengguna Umum.

---

## 1. Masuk ke Aplikasi (Login)
1. Buka halaman utama aplikasi di browser (`http://127.0.0.1:8000`).
2. Masukkan **Email** dan **Password** sesuai dengan akun yang terdaftar (misal akun Admin: `admin@simada.com` / `admin123`).
3. Klik tombol **Login** untuk masuk ke halaman Dashboard.

---

## 2. Navigasi Dashboard Utama
Di halaman Dashboard, Anda dapat melihat:
- **Ringkasan Statistik:** Total Paket, Total Pagu Anggaran, dan Realisasi Anggaran.
- **Grafik Anggaran:** Perbandingan Rencana Anggaran vs Realisasi Anggaran per bulan.
- **Tracking Progress:** Widget visual persentase kemajuan paket pengadaan yang sedang berjalan.
- **Tabel Daftar Paket Pengadaan:** Berisi informasi singkat kode, nama paket, OPD, metode, status, progress, serta tombol aksi.

---

## 3. Mengelola Paket Pengadaan
### A. Menambah Paket Baru (Admin / Petugas)
1. Klik tombol hijau **"+ Tambah Paket"** di menu samping kiri.
2. Isi formulir dengan lengkap, meliputi:
   - Kode Paket & Nama Paket
   - OPD Penanggung Jawab
   - Jenis Pengadaan & Metode
   - Pagu (Rp) & Nilai Kontrak (Rp)
   - Tahun Anggaran & Status (*Perencanaan*, *Proses*, *Selesai*)
   - **Progress (%)**: Masukkan angka kemajuan (0 - 100).
3. Klik **Simpan Paket**. Sistem akan otomatis menyimpan data dan mengarahkan Anda kembali ke Dashboard.

### B. Mengubah / Memperbarui Paket (Edit)
1. Pada tabel Daftar Paket di Dashboard, klik tombol hijau **"Edit / Update"** pada baris paket yang ingin diubah.
2. Sesuaikan data atau ubah nilai persentase **Progress (%)**.
3. Klik **Simpan Perubahan** untuk memperbarui data.

### C. Menghapus Paket
1. Pada baris paket yang ingin dihapus di tabel Dashboard, klik tombol merah **"Hapus"**.
2. Konfirmasi penghapusan jika diminta. Data akan langsung terhapus dari sistem.

---

## 4. Manajemen Pengguna (Khusus Admin)
1. Klik menu **"Kelola User"** di bilah navigasi samping kiri.
2. Anda akan melihat daftar pengguna aktif beserta peran (*Role*) masing-masing.
3. Gunakan tombol **Tambah User**, **Edit**, atau **Hapus** untuk mengelola hak akses akun.

---

## 5. Ekspor Laporan (Excel & PDF)
1. Pada menu laporan di sebelah kiri dashboard, tersedia dua pilihan format ekspor:
   - **Ekspor Excel:** Mengunduh data rekapitulasi dalam bentuk spreadsheet.
   - **Ekspor PDF:** Membuka pratinjau laporan cetak dalam format PDF.
2. Pada halaman pratinjau PDF, Anda dapat mengklik tombol **Cetak / Simpan PDF** di pojok kanan atas untuk langsung mencetak dokumen, atau klik **Kembali ke Dashboard** di pojok kiri atas untuk keluar dari halaman laporan.
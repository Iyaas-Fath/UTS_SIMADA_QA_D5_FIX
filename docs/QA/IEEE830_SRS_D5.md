# Software Requirements Specification – SIMADA D5
**Dokumentasi tugas mengacu IEEE 830-1998**

## 1. Pendahuluan
### 1.1 Tujuan
Menentukan kebutuhan yang dapat diuji untuk modul Dashboard & Reporting D5 SIMADA.
### 1.2 Ruang Lingkup
Modul menyajikan ringkasan paket pengadaan, pagu, realisasi kontrak, tren bulanan, tracking progres, daftar paket, dan ekspor data.
### 1.3 Referensi sumber
KAK SIMADA bagian lingkup kegiatan dan informasi/laporan (pagu dan realisasi menurut OPD, jenis, metode, waktu; output dapat dicetak/diunduh); SDD Section 5.2.5 dan 7.1; Requirement Analysis & Design bagian W2 Dashboard.
### 1.4 Istilah
- Pagu: nilai rencana anggaran pada `procurement_packages.pagu`.
- Realisasi: nilai kontrak pada `procurement_packages.nilai_kontrak`.
- OPD: Organisasi Perangkat Daerah.

## 2. Deskripsi Umum
### 2.1 Perspektif Produk
Modul adalah bagian dari aplikasi web SIMADA Laravel dengan arsitektur MVC.
### 2.2 Kelas Pengguna
Admin, PA/KPA, PPK, Pokja Pemilihan, dan Pejabat Pengadaan sebagaimana role yang disebut pada dokumen SIMADA.
### 2.3 Batasan
Backend Laravel/PHP >= 8.1; DB MySQL atau PostgreSQL secara konseptual, tetapi migration perlu diverifikasi pada DBMS target; dashboard hanya dapat diakses setelah login.
### 2.4 Asumsi dan Ketergantungan
Data paket, OPD, dan tahapan harus tersedia; persentase dihitung dari total realisasi dibagi total pagu; jika total pagu nol, persentase bernilai nol.

## 3. Kebutuhan Spesifik
| ID | Kebutuhan | Prioritas | Kriteria penerimaan |
|---|---|---|---|
| FR-D5-01 | Sistem menyediakan filter tahun, OPD, jenis, dan metode. | MUST | Filter mengubah ringkasan, grafik, tracking, dan tabel. |
| FR-D5-02 | Sistem menghitung jumlah paket. | MUST | Nilai sama dengan COUNT paket sesuai filter. |
| FR-D5-03 | Sistem menjumlahkan pagu. | MUST | Nilai sama dengan SUM pagu sesuai filter. |
| FR-D5-04 | Sistem menjumlahkan nilai kontrak sebagai realisasi. | MUST | Nilai NULL tidak menambah total realisasi. |
| FR-D5-05 | Sistem menghitung persentase realisasi terhadap pagu. | MUST | SUM(nilai_kontrak)/SUM(pagu)*100; pagu nol menghasilkan 0%. |
| FR-D5-06 | Sistem menampilkan rencana vs realisasi per bulan. | MUST | Data dikelompokkan menurut bulan kontrak/tahun fallback sesuai implementasi. |
| FR-D5-07 | Sistem menampilkan tracking progress paket. | MUST | Nama paket, OPD, tahapan, status tahap, progres tampil. |
| FR-D5-08 | Sistem menampilkan tabel paket pengadaan. | MUST | Tabel memuat kode, nama, OPD, jenis, metode, tahun, pagu, kontrak, status, progres. |
| FR-D5-09 | Sistem menyediakan ekspor laporan yang bisa dibuka di Excel. | MUST | Ekspor CSV mengikuti filter yang sedang dipilih. |
| NFR-D5-01 | Dashboard memerlukan autentikasi dan pemeriksaan role. | MUST | Guest diarahkan ke login; role yang tidak diizinkan ditolak. |
| NFR-D5-02 | Data ditampilkan sesuai pembatasan OPD bagi user yang terikat OPD. | MUST | User non-admin dengan opd_id hanya melihat paket OPD-nya. |
| NFR-D5-03 | Antarmuka responsif. | SHOULD | Tata letak menyesuaikan layar ponsel dan desktop. |

## 4. Aturan Bisnis
1. Total paket = jumlah paket setelah filter.
2. Total pagu = jumlah nilai `pagu` paket terfilter.
3. Total realisasi = jumlah `nilai_kontrak`; NULL diperlakukan sebagai 0.
4. Persentase = total realisasi / total pagu × 100; jika total pagu 0, hasil 0.
5. Filter yang kosong tidak membatasi dimensi tersebut.
6. Data contoh dalam seeder tidak mewakili data resmi pemerintah.

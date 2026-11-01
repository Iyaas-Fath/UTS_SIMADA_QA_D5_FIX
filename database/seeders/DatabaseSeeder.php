<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Opd;
use App\Models\ProcurementPackage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate/Hapus user lama agar tidak bentrok
        User::truncate();

        // 1. Akun Admin
        User::create([
            'name'     => 'Admin SIMADA',
            'email'    => 'admin@simada.com',
            'password' => Hash::make('admin123'),
            'role'     => 'ADMIN',
        ]);

        // 2. Akun Petugas
        User::create([
            'name'     => 'Petugas SIMADA',
            'email'    => 'petugas@simada.com',
            'password' => Hash::make('petugas123'),
            'role'     => 'PETUGAS',
        ]);

        // 3. Akun Masyarakat
        User::create([
            'name'     => 'Masyarakat',
            'email'    => 'user@simada.com',
            'password' => Hash::make('user123'),
            'role'     => 'MASYARAKAT',
        ]);
       // 2. Buat Beberapa Data OPD
        $opd1 = Opd::create([
            'kode_opd' => 'OPD-01',
            'nama_opd' => 'Dinas Komunikasi dan Informatika'
        ]);

        $opd2 = Opd::create([
            'kode_opd' => 'OPD-02',
            'nama_opd' => 'Dinas Pekerjaan Umum dan Penataan Ruang'
        ]);

        $opd3 = Opd::create([
            'kode_opd' => 'OPD-03',
            'nama_opd' => 'Dinas Kesehatan'
        ]);

        $opdList = [$opd1, $opd2, $opd3];

        // 3. Data Pendukung untuk Kombinasi Jenis dan Metode
        $jenisList = ['Barang', 'Jasa', 'Pekerjaan Konstruksi', 'Jasa Konsultansi'];
        $metodeList = ['e-Tendering', 'e-Pengadaan Langsung', 'e-Purchasing'];
        $statusList = ['Perencanaan', 'Proses', 'Selesai'];

        $counter = 1;

        // Loop untuk membuat data paket pengadaan yang terdistribusi ke berbagai OPD
        foreach ($opdList as $opd) {
            foreach ($jenisList as $jenis) {
                foreach ($metodeList as $metode) {
                    ProcurementPackage::create([
                        'kode_paket' => 'SIMADA-' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                        'nama_paket' => 'Paket ' . $jenis . ' ' . $metode,
                        'opd_id' => $opd->id,
                        'jenis_pengadaan' => $jenis,
                        'metode' => $metode,
                        'pagu' => rand(100, 500) * 1000000,
                        'nilai_kontrak' => rand(80, 450) * 1000000,
                        'tahun_anggaran' => 2026,
                        'status' => $statusList[array_rand($statusList)],
                        'progress' => 77, // ubah dari 'progress_persen' menjadi 'progress'
                        'tanggal_kontrak' => '2026-03-15',
                    ]);
                    $counter++;
                }
            }
        }
    }
}
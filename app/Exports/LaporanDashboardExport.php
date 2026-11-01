<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanDashboardExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kode Paket',
            'Nama Paket',
            'Jenis Pengadaan',
            'Metode',
            'Pagu Anggaran',
            'Nilai Kontrak/Realisasi',
            'Tahun Anggaran'
        ];
    }

    public function map($package): array
    {
        return [
            $package->id,
            $package->kode_paket,
            $package->nama_paket,
            $package->jenis_pengadaan,
            $package->metode,
            $package->pagu,
            $package->nilai_kontrak,
            $package->tahun_anggaran,
        ];
    }
}

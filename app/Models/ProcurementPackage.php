<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcurementPackage extends Model
{
    // Mengunci nama tabel sesuai database di phpMyAdmin
    protected $table = 'procurement_packages';

    protected $fillable = [
    'kode_paket',
    'nama_paket',
    'opd_id',
    'jenis_pengadaan',
    'metode',
    'pagu',
    'nilai_kontrak',
    'status',
    'progress', // <-- Pastikan ini ada
    'tahun_anggaran',
];


    /**
     * Korelasi: Setiap paket dimiliki oleh satu OPD/Dinas
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }
    
}

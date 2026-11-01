<?php

namespace App\Services;

use App\Models\ProcurementPackage;
use Illuminate\Http\Request;

class DashboardService
{
    public function getFilteredQuery(Request $request)
    {
        $query = ProcurementPackage::query();

        // FIX TC-016: Hak akses OPD non-admin
        if (auth()->check() && auth()->user()->role !== 'ADMIN') {
            $query->where('opd_id', auth()->user()->opd_id);
        }

        // Filter Dropdown
        if ($request->filled('tahun')) {
            $query->where('tahun_anggaran', $request->tahun); 
        }
        if ($request->filled('opd') && auth()->user()->role === 'ADMIN') {
            $query->where('opd_id', $request->opd);
        }
        if ($request->filled('jenis_pengadaan')) {
            $query->where('jenis_pengadaan', $request->jenis_pengadaan); 
        }
        if ($request->filled('metode_pengadaan')) {
            $query->where('metode', $request->metode_pengadaan); 
        }

        return $query;
    }

    public function getMonthlyChartData($queryInstance)
    {
        $grafikRencana = array_fill(0, 12, 0);
        $grafikRealisasi = array_fill(0, 12, 0);

        $packages = (clone $queryInstance)->get();

        foreach ($packages as $index => $package) {
            $bulanIndex = ($index % 12); 
            $grafikRencana[$bulanIndex] += (int) $package->pagu;
            $grafikRealisasi[$bulanIndex] += (int) $package->nilai_kontrak;
        }

        return [
            'rencana' => $grafikRencana,
            'realisasi' => $grafikRealisasi
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\ProcurementPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahunSelected = $request->query('tahun');
        $opdSelected = $request->query('opd');
        $jenisSelected = $request->query('jenis_pengadaan');
        $metodeSelected = $request->query('metode_pengadaan');

        $query = ProcurementPackage::with('opd');

        // Filter berdasarkan nama kolom asli DB
        if (!empty($tahunSelected)) {
            $query->where('tahun_anggaran', $tahunSelected);
        }

        if (!empty($opdSelected)) {
            $query->where('opd_id', $opdSelected);
        }

        if (!empty($jenisSelected)) {
            $query->where('jenis_pengadaan', $jenisSelected);
        }

        if (!empty($metodeSelected)) {
            $query->where('metode', $metodeSelected);
        }

        $packages = $query->latest()->get();

        // Hitung Metrics Utama
        $totalPaket = $packages->count();
        $totalPagu = $packages->sum('pagu');
        $realisasiAnggaran = $packages->sum('nilai_kontrak');
        $persenRealisasi = $totalPagu > 0 ? round(($realisasiAnggaran / $totalPagu) * 100, 1) : 0;

        // Formating Data Grafik Per Bulan (Sesuai tanggal_kontrak atau created_at)
        $chartRencana = array_fill(0, 12, 0);
        $chartRealisasi = array_fill(0, 12, 0);

        foreach ($packages as $pkg) {
            $date = $pkg->tanggal_kontrak ?? $pkg->created_at;
            $month = !empty($date) ? intval(date('n', strtotime($date))) - 1 : 0;

            if ($month >= 0 && $month < 12) {
                // Skala Grafik dalam Juta Rupiah
                $chartRencana[$month] += round(($pkg->pagu ?? 0) / 1000000, 2);
                $chartRealisasi[$month] += round(($pkg->nilai_kontrak ?? 0) / 1000000, 2);
            }
        }

        $opdList = Opd::all();
        $tahunList = [2026, 2025, 2024];
        $jenisList = ['Barang', 'Jasa', 'Pekerjaan Konstruksi', 'Jasa Konsultansi'];
        $metodeList = ['e-Tendering', 'e-Pengadaan Langsung', 'e-Purchasing'];

        return view('dashboard.index', compact(
            'packages', 'totalPaket', 'totalPagu', 'realisasiAnggaran', 'persenRealisasi',
            'opdList', 'tahunList', 'jenisList', 'metodeList',
            'tahunSelected', 'opdSelected', 'jenisSelected', 'metodeSelected',
            'chartRencana', 'chartRealisasi'
        ));
    }

    public function exportExcel()
    {
        $packages = ProcurementPackage::with('opd')->latest()->get();
        $fileName = 'Laporan_Pengadaan_SIMADA.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Nama Paket', 'OPD', 'Jenis Pengadaan', 'Metode', 'Pagu (Rp)', 'Nilai Kontrak (Rp)', 'Status', 'Progress (%)'];

        $callback = function() use($packages, $columns) {
            $file = fopen('php://output', 'w');
            
            // Tambahkan BOM agar Excel membaca karakter dengan rapi (UTF-8)
            fputs($file, "\xEF\xBB\xBF");
            
            // Header kolom
            fputcsv($file, $columns);

            // Isi baris data
            $no = 1;
            foreach ($packages as $p) {
                fputcsv($file, [
                    $no++,
                    $p->nama_paket,
                    $p->opd->nama_opd ?? $p->opd->name ?? 'Dinas Terkait',
                    $p->jenis_pengadaan,
                    $p->metode,
                    $p->pagu,
                    $p->nilai_kontrak,
                    $p->status,
                    $p->progress_persen ?? 0
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf()
    {
        // Ambil semua data paket pengadaan beserta relasi OPD-nya
        $packages = ProcurementPackage::with('opd')->latest()->get();

        // Hitung total untuk ringkasan laporan sesuai nama variabel di file PDF kamu
        $total_paket = $packages->count();
        $total_pagu = $packages->sum('pagu');
        $total_realisasi = $packages->sum('nilai_kontrak');

        // Kirim data ke view PDF
        return view('dashboard.dashboard_pdf', compact(
            'packages',
            'total_paket',
            'total_pagu',
            'total_realisasi'
        ));
    }}
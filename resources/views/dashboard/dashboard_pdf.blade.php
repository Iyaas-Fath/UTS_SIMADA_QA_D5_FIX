<!DOCTYPE html>
<html>
<head>
    <title>Laporan SIMADA</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .text-right { text-align: right; }

        /* Tambahkan style print di sini, DI DALAM tag <style> */
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Navigasi (Kembali & Print) -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;" class="d-print-none">
    <!-- Tombol Kembali ke Dashboard (Pojok Kiri Atas) -->
    <a href="{{ route('dashboard') }}" style="padding: 8px 16px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
        &larr; Kembali ke Dashboard
    </a>

    <!-- Tombol Cetak / Print (Pojok Kanan Atas) -->
    <button onclick="window.print()" style="padding: 8px 16px; background-color: #198754; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">
        🖨️ Cetak / Simpan PDF
    </button>
</div>
    
    
</div>
    <div class="header">
        <h2>LAPORAN PENGADAAN BARANG DAN JASA</h2>
        <h3>Sistem Informasi Pengadaan Daerah (SIMADA)</h3>
    </div>

    <div>
        <strong>Ringkasan:</strong><br>
        Total Paket: {{ $total_paket }} Paket<br>
        Total Pagu: Rp {{ number_format($total_pagu, 0, ',', '.') }}<br>
        Total Realisasi: Rp {{ number_format($total_realisasi, 0, ',', '.') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Paket</th>
                <th>Jenis</th>
                <th>Metode</th>
                <th class="text-right">Pagu</th>
                <th class="text-right">Nilai Kontrak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->kode_paket }}</td>
                <td>{{ $package->nama_paket }}</td>
                <td>{{ $package->jenis_pengadaan }}</td>
                <td>{{ $package->metode }}</td>
                <td class="text-right">Rp {{ number_format($package->pagu, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($package->nilai_kontrak, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        <!-- Kolom Tanda Tangan -->
    <div style="width: 100%; margin-top: 50px; page-break-inside: avoid;">
        <table width="100%" style="border: none;">
            <tr>
                <td width="60%" style="border: none;"></td>
                <td width="40%" style="text-align: center; border: none; font-family: sans-serif; font-size: 14px;">
                    <p style="margin-bottom: 5px;">Bekasi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p style="margin-top: 0; margin-bottom: 60px;">
                        Mengetahui,<br>
                        <b>Pejabat Pembuat Komitmen (PPK)</b>
                    </p>
                    
                    <p style="margin-bottom: 0;">
    <b><u>{{ auth()->user()->name ?? 'Pejabat Berwenang' }}</u></b><br>
    Role: {{ strtoupper(auth()->user()->role ?? 'PEGAWAI') }}
</p>
                </td>
            </tr>
        </table>
    </div>
        </tbody>
    </table>
</body>
</html>

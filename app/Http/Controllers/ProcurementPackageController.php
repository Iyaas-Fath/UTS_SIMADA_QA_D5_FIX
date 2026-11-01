<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\ProcurementPackage;
use Illuminate\Http\Request;

class ProcurementPackageController extends Controller
{
    public function create()
    {
        $opdList = Opd::all();
        return view('packages.create', compact('opdList'));
    }

public function store(Request $request)
{
    // Validasi...
    $request->validate([
        'kode_paket'      => 'required|string|max:255',
        'nama_paket'      => 'required|string|max:255',
        'opd_id'          => 'required',
        'jenis_pengadaan' => 'required|string',
        'metode'          => 'required|string',
        'pagu'            => 'required|numeric',
        'nilai_kontrak'   => 'required|numeric',
        'tahun_anggaran'  => 'required|numeric',
        'status'          => 'required|string',
        'progress'        => 'required|numeric|min:0|max:100',
    ]);

    // Simpan ke database
    ProcurementPackage::create([
        'kode_paket'      => $request->kode_paket,
        'nama_paket'      => $request->nama_paket,
        'opd_id'          => $request->opd_id,
        'jenis_pengadaan' => $request->jenis_pengadaan,
        'metode'          => $request->metode,
        'pagu'            => $request->pagu,
        'nilai_kontrak'   => $request->nilai_kontrak,
        'tahun_anggaran'  => $request->tahun_anggaran,
        'status'          => $request->status,
        'progress'        => $request->progress,
    ]);

    // Kembalikan ke dashboard
    return redirect()->route('dashboard')->with('success', 'Paket pengadaan berhasil ditambahkan.');
}

    public function destroy($id)
{
    $package = \App\Models\ProcurementPackage::findOrFail($id);
    $package->delete();

    return redirect()->route('dashboard')->with('success', 'Paket pengadaan berhasil dihapus.');
}
public function edit($id)
{
    if (strtoupper(auth()->user()->role) === 'MASYARAKAT') {
        abort(403, 'Unauthorized action.');
    }

    $package = ProcurementPackage::findOrFail($id);
    return view('packages.edit', compact('package'));
}

public function update(Request $request, $id)
{
    $package = ProcurementPackage::findOrFail($id);

    $request->validate([
        'nama_paket'     => 'required|string|max:255',
        'pagu'           => 'required|numeric',
        'nilai_kontrak'  => 'required|numeric',
        'status'         => 'required|string',
        'progress'       => 'required|numeric|min:0|max:255',
    ]);

    $package->update([
        'nama_paket'     => $request->nama_paket,
        'jenis_pengadaan'=> $request->jenis_pengadaan,
        'metode'         => $request->metode,
        'pagu'           => $request->pagu,
        'nilai_kontrak'  => $request->nilai_kontrak,
        'status'         => $request->status,
        'progress'       => $request->progress, // <--- Pastikan ini ada
    ]);

    // <--- Pastikan arah redirect-nya kembali ke dashboard di sini:
    return redirect()->route('dashboard')->with('success', 'Paket pengadaan berhasil diperbarui.');
}
};
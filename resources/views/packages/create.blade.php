<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Pengadaan - SIMADA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Paket Pengadaan Baru</h2>
        
        <form action="{{ route('packages.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Kode Paket</label>
                <input type="text" name="kode_paket" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Paket</label>
                <input type="text" name="nama_paket" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">OPD</label>
                <select name="opd_id" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    @foreach($opdList as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Pengadaan</label>
                    <select name="jenis_pengadaan" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="Barang">Barang</option>
                        <option value="Jasa">Jasa</option>
                        <option value="Pekerjaan Konstruksi">Pekerjaan Konstruksi</option>
                        <option value="Jasa Konsultansi">Jasa Konsultansi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Metode</label>
                    <select name="metode" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="e-Tendering">e-Tendering</option>
                        <option value="e-Pengadaan Langsung">e-Pengadaan Langsung</option>
                        <option value="e-Purchasing">e-Purchasing</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pagu (Rp)</label>
                    <input type="number" name="pagu" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nilai Kontrak (Rp)</label>
                    <input type="number" name="nilai_kontrak" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tahun Anggaran</label>
                    <input type="number" name="tahun_anggaran" value="2026" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        <option value="Perencanaan">Perencanaan</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Progress (%)</label>
<input type="number" name="progress" min="0" max="100" value="0" class="w-full mt-1 p-2 border border-gray-300 rounded-md">                </div>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Simpan Paket</button>
            </div>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Pengadaan - SIMADA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Perbarui Progres & Paket Pengadaan</h2>
        
        <form action="{{ route('packages.update', $package->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Kode Paket</label>
                <input type="text" value="{{ $package->kode_paket }}" disabled class="w-full mt-1 p-2 border border-gray-300 rounded-md bg-gray-100">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Paket</label>
                <input type="text" name="nama_paket" value="{{ $package->nama_paket }}" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Pengadaan</label>
                    <select name="jenis_pengadaan" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        @foreach(['Barang', 'Jasa', 'Pekerjaan Konstruksi', 'Jasa Konsultansi'] as $jenis)
                            <option value="{{ $jenis }}" {{ $package->jenis_pengadaan == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Metode</label>
                    <select name="metode" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        @foreach(['e-Tendering', 'e-Pengadaan Langsung', 'e-Purchasing', 'Penunjukan Langsung'] as $m)
                            <option value="{{ $m }}" {{ $package->metode == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pagu (Rp)</label>
                    <input type="number" name="pagu" value="{{ $package->pagu }}" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nilai Kontrak (Rp)</label>
                    <input type="number" name="nilai_kontrak" value="{{ $package->nilai_kontrak }}" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" required class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                        @foreach(['Perencanaan', 'Proses', 'Selesai'] as $st)
                            <option value="{{ $st }}" {{ $package->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
    <div class="mb-3">
    <label for="progress" class="form-label">Progress (%)</label>
    <input type="number" class="form-control" id="progress" name="progress" value="{{ old('progress', $package->progress) }}" min="0" max="100" required>
</div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
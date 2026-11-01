<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SIMADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { background-color: #ffffff; min-height: 100vh; box-shadow: 2px 0 10px rgba(0,0,0,0.05); }
        /* Ubah warna judul SIMADA jadi Hijau */
        .brand-title { color: #198754; font-weight: 700; }
        /* Ubah menu aktif jadi Hijau */
        .nav-link.active { background-color: #198754 !important; color: #ffffff !important; font-weight: 600; }
        .nav-link { color: #495057; border-radius: 8px; margin-bottom: 4px; transition: all 0.2s; }
        /* Ubah hover menu jadi warna hijau transparan */
        .nav-link:hover { background-color: #e8f5e9; color: #198754; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); background-color: #ffffff; }
        .progress-bar-custom { background-color: #198754; border-radius: 10px; }
        
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-2 sidebar p-3 d-flex flex-column justify-content-between">
            <div>
                <div class="mb-4 text-center text-md-start px-2">
                    <h3 class="brand-title mb-0">SIMADA</h3>
                    <small class="text-muted">Sistem Informasi Pengadaan</small>
                </div>

                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                        </a>
                    </li>
                    

                    @if(auth()->check() && strtoupper(auth()->user()->role) === 'ADMIN')
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="bi bi-people-fill me-2"></i> Kelola User
                        </a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahPaketModal" style="background-color: #059669; color: #ffffff; padding: 10px 16px; border-radius: 6px; font-weight: bold; text-decoration: none; display: inline-block; border: none; width: 100%; text-align: left;">+ Tambah Paket</button>
                    </li>
                    @endif

                    @if(auth()->check() && in_array(strtoupper(auth()->user()->role), ['ADMIN', 'PETUGAS']))
                    <li class="nav-item mt-3">
                        <small class="text-muted px-2 text-uppercase fw-bold" style="font-size: 11px;">LAPORAN</small>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.export.excel') }}" class="nav-link text-success">
                            <i class="bi bi-file-earmark-excel-fill me-2"></i> Ekspor Excel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.export.pdf') }}" class="nav-link text-danger">
                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Ekspor PDF
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

            <!-- Profile & Logout Panel -->
            <div class="border-top pt-3">
                <div class="d-flex align-items-center mb-3 px-2">
                    <!-- Ubah Profil Circle jadi bg-success -->
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 38px; height: 38px; font-weight: bold;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-bold text-truncate" style="max-width: 120px;">{{ auth()->user()->name ?? 'User' }}</div>
<!-- Ubah Badge Role jadi bg-success -->
                        <span class="badge bg-success text-uppercase" style="font-size: 10px;">{{ auth()->user()->role ?? 'GUEST' }}</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-danger w-100 btn-sm rounded-3">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
    </button>
</form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Dashboard SIMADA</h3>
                <p class="text-muted mb-0">Ringkasan pengadaan barang dan jasa Pemerintah Daerah</p>
            </div>
</a>

            <!-- Filter Panel -->
            <div class="card card-custom p-3 mb-4">
                <form id="filterForm" method="GET" action="{{ route('dashboard') }}" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Tahun</label>
                        <select name="tahun" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $t)
                                <option value="{{ $t }}" {{ $tahunSelected == $t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">OPD</label>
                        <select name="opd" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua OPD</option>
                            @foreach($opdList as $opd)
                                <option value="{{ $opd->id }}" {{ $opdSelected == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->nama_opd ?? $opd->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Jenis Pengadaan</label>
                        <select name="jenis_pengadaan" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisList as $j)
                                <option value="{{ $j }}" {{ $jenisSelected == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Metode Pengadaan</label>
                        <select name="metode_pengadaan" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Metode</option>
                            @foreach($metodeList as $m)
                                <option value="{{ $m }}" {{ $metodeSelected == $m ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <!-- Key Metrics Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <small class="text-muted fw-bold">Total Paket</small>
                        <h2 class="fw-bold my-1">{{ $totalPaket }}</h2>
                        <small class="text-muted" style="font-size: 12px;">Seluruh paket tahun {{ $tahunSelected ?? 'Semua' }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <small class="text-muted fw-bold">Total Pagu</small>
                        <!-- Ubah nominal jadi text-success -->
                        <h2 class="fw-bold my-1 text-success">Rp {{ number_format($totalPagu, 0, ',', '.') }}</h2>
                        <small class="text-muted" style="font-size: 12px;">Total anggaran pengadaan</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <small class="text-muted fw-bold">Realisasi Anggaran</small>
                        <h2 class="fw-bold my-1 text-success">Rp {{ number_format($realisasiAnggaran, 0, ',', '.') }}</h2>
                        <small class="text-success fw-bold" style="font-size: 12px;">{{ $persenRealisasi }}% dari total pagu</small>
                    </div>
                </div>
            </div>

            <!-- Charts & Tracking Progress -->
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <div class="card card-custom p-3 h-100">
                        <h6 class="fw-bold mb-1">Rencana Anggaran vs Realisasi Anggaran</h6>
                        <p class="text-muted small mb-3">Perbandingan anggaran pengadaan per bulan</p>
                        <div style="height: 250px;">
                            <canvas id="anggaranChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                        </div>
                        <h6 class="fw-bold mb-1">Tracking Progress</h6>
                        <p class="text-muted small mb-3">Progres paket pengadaan berjalan</p>

                    @forelse($packages->take(3) as $pkg)
    <div class="mb-3">
        <div class="d-flex justify-content-between small fw-bold mb-1">
            <span>{{ $pkg->nama_paket }}</span>
            <span class="{{ ($pkg->progress ?? 0) > 50 ? 'text-success' : 'text-muted' }}">{{ $pkg->progress ?? 0 }}%</span>
        </div>
        <div class="progress" style="height: 6px;">
            <div class="progress-bar {{ ($pkg->progress ?? 0) > 0 ? 'progress-bar-custom' : 'bg-secondary' }}" style="width: {{ $pkg->progress ?? 0 }}%;"></div>
        </div>
        <small class="text-muted" style="font-size: 11px;">{{ $pkg->opd->nama_opd ?? $pkg->opd->name ?? 'Dinas Terkait' }}</small>
    </div>
@empty
    <div class="text-muted small text-center py-3">Tidak ada data tracking.</div>
@endforelse
                    </div>
                </div>
            </div>

            <!-- Paket Pengadaan Table Panel -->
            <div class="card card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Paket Pengadaan</h5>
                        <p class="text-muted small mb-0">Daftar singkat paket dan progres pengadaan</p>
                        
                    </div>
                    <div>
                    </div>
                </div>

               <div class="table-responsive">
    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th>Nama Paket</th>
                <th>OPD</th>
                <th>Metode</th>
                <th>Status</th>
                <th style="width: 200px;">Progress</th>
                @if(auth()->check() && in_array(strtoupper(auth()->user()->role), ['ADMIN', 'PETUGAS']))
                    <th class="text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($packages as $sp)
                <tr>
                    <td class="fw-bold">{{ $sp->nama_paket }}</td>
                    <td class="text-muted">{{ $sp->opd->nama_opd ?? 'Dinas Terkait' }}</td>
                    <td class="text-muted">{{ $sp->metode }}</td>
                    
                    <!-- KOLOM STATUS -->
                    <td>
                        @if(strtolower($sp->status ?? '') == 'selesai')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Selesai</span>
                        @elseif(strtolower($sp->status ?? '') == 'proses')
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Proses</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">Perencanaan</span>
                        @endif
                    </td>

                    <!-- KOLOM PROGRESS -->
                    <td>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $sp->progress ?? 0 }}%;" aria-valuenow="{{ $sp->progress ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="small text-muted">{{ $sp->progress ?? 0 }}%</span>
                    </td>

                    <!-- KOLOM AKSI (Hanya tampil untuk Admin & Petugas) -->
                    @if(auth()->check() && in_array(strtoupper(auth()->user()->role), ['ADMIN', 'PETUGAS']))
                        <td class="temp-aksi text-center">
                            <!-- Tombol Edit Modal -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#editPaketModal{{ $sp->id }}" style="background-color: #059669; color: white; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; border: none; display: inline-block;">
                                Edit / Update
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('packages.destroy', $sp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ms-1">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>

                <!-- Modal Edit Paket per baris ID -->
<!-- Modal Edit Paket per baris ID -->
@if(auth()->check() && in_array(strtoupper(auth()->user()->role), ['ADMIN', 'PETUGAS']))
<div class="modal fade" id="editPaketModal{{ $sp->id }}" tabindex="-1" aria-labelledby="editPaketModalLabel{{ $sp->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title fw-bold" id="editPaketModalLabel{{ $sp->id }}">Perbarui Progres & Paket Pengadaan</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('packages.update', $sp->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body p-4 text-start">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Kode Paket</label>
                                        <input type="text" name="kode_paket" class="form-control" value="{{ $sp->kode_paket ?? '' }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama Paket</label>
                                        <input type="text" name="nama_paket" class="form-control" value="{{ $sp->nama_paket ?? '' }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Jenis Pengadaan</label>
                                            <select name="jenis_pengadaan" class="form-select" required>
                                                <option value="Barang" {{ ($sp->jenis_pengadaan ?? '') == 'Barang' ? 'selected' : '' }}>Barang</option>
                                                <option value="Jasa" {{ ($sp->jenis_pengadaan ?? '') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                                <option value="Pekerjaan Konstruksi" {{ ($sp->jenis_pengadaan ?? '') == 'Pekerjaan Konstruksi' ? 'selected' : '' }}>Pekerjaan Konstruksi</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Metode</label>
                                            <select name="metode" class="form-select" required>
                                                <option value="e-Tendering" {{ ($sp->metode ?? '') == 'e-Tendering' ? 'selected' : '' }}>e-Tendering</option>
                                                <option value="e-Pengadaan Langsung" {{ ($sp->metode ?? '') == 'e-Pengadaan Langsung' ? 'selected' : '' }}>e-Pengadaan Langsung</option>
                                                <option value="Pengadaan Langsung" {{ ($sp->metode ?? '') == 'Pengadaan Langsung' ? 'selected' : '' }}>Pengadaan Langsung</option>
                                                <option value="e-Purchasing" {{ ($sp->metode ?? '') == 'e-Purchasing' ? 'selected' : '' }}>e-Purchasing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Pagu (Rp)</label>
                                            <input type="number" name="pagu" class="form-control" value="{{ $sp->pagu ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Nilai Kontrak (Rp)</label>
                                            <input type="number" name="nilai_kontrak" class="form-control" value="{{ $sp->nilai_kontrak ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="Perencanaan" {{ strtolower($sp->status ?? '') == 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                                                <option value="Proses" {{ strtolower($sp->status ?? '') == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="Selesai" {{ strtolower($sp->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Progress (%)</label>
                                            <input type="number" name="progress" class="form-control" min="0" max="100" value="{{ $sp->progress ?? 0 }}" required>
                                        </div>
                                    </div>
                                </div>
                               <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm px-4">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@empty
    <tr>
        <td colspan="6" class="text-center py-4 text-muted">Tidak ada paket pengadaan yang sesuai dengan filter.</td>
    </tr>
@endforelse
</tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const dataRencana = @json($chartRencana);
    const dataRealisasi = @json($chartRealisasi);

    const ctx = document.getElementById('anggaranChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Rencana (Juta Rp)',
                    data: dataRencana,
                    backgroundColor: '#cbd5e1',
                    borderRadius: 4
                },
                {
                    label: 'Realisasi (Juta Rp)',
                    data: dataRealisasi,
                    backgroundColor: '#198754', /* Warna Chart Hijau SIMADA */
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Modal Tambah Paket -->
<div class="modal fade" id="tambahPaketModal" tabindex="-1" aria-labelledby="tambahPaketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="tambahPaketModalLabel">Tambah Paket Pengadaan Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Form mengarah ke route store backend yang sudah ada -->
            <form action="{{ route('packages.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Paket</label>
                        <input type="text" name="kode_paket" class="form-control" required placeholder="Masukkan kode paket...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Paket</label>
                        <input type="text" name="nama_paket" class="form-control" required placeholder="Masukkan nama paket...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">OPD</label>
                        <select name="opd_id" class="form-select" required>
                            <option value="">Pilih OPD</option>
                            @foreach($opdList as $opd)
                                <option value="{{ $opd->id }}">{{ $opd->nama_opd ?? $opd->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Pengadaan</label>
                            <select name="jenis_pengadaan" class="form-select" required>
                                <option value="Barang">Barang</option>
                                <option value="Jasa">Jasa</option>
                                <option value="Pekerjaan Konstruksi">Pekerjaan Konstruksi</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Metode</label>
                            <select name="metode" class="form-select" required>
                                <option value="e-Tendering">e-Tendering</option>
                                <option value="e-Pengadaan Langsung">e-Pengadaan Langsung</option>
                                <option value="Pengadaan Langsung">Pengadaan Langsung</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pagu (Rp)</label>
                            <input type="number" name="pagu" class="form-control" required placeholder="Contoh: 100000000">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nilai Kontrak (Rp)</label>
                            <input type="number" name="nilai_kontrak" class="form-control" placeholder="Contoh: 95000000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Tahun Anggaran</label>
                            <input type="number" name="tahun_anggaran" class="form-control" value="2026" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Perencanaan">Perencanaan</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Progress (%)</label>
                            <input type="number" name="progress" class="form-control" min="0" max="100" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm px-4">Simpan Paket</button>
                </div>
            </form>
        </div>
    </div>
</div>
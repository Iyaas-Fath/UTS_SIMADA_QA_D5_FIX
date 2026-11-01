<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - SIMADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Pengguna (User)</h3>
        <div>
            <!-- Tombol Tambah User Baru -->
            <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm me-2">
                <i class="bi bi-plus-circle me-1"></i> Tambah User
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <table class="table table-bordered align-middle">
        <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th class="text-center">Aksi</th> <!-- Cukup satu kolom Aksi -->
    </tr>
</thead>
        <tbody>
            @foreach($users as $index => $u)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge bg-primary">{{ $u->role }}</span></td>
                <td>
    <!-- Tombol Edit -->
    <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

    <!-- Tombol Hapus yang sudah ada -->
    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
    </form>
</td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
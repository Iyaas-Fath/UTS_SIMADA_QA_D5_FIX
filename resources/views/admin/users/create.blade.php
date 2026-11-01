<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User - SIMADA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
    <h4 class="fw-bold mb-4 text-success">Tambah Pengguna Baru</h4>
    
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama..." required>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-semibold">Role Hak Akses</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="ADMIN">ADMIN</option>
                <option value="PETUGAS">PETUGAS</option>
                <option value="MASYARAKAT">MASYARAKAT</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter..." required minlength="8">
        </div>
        
        <hr>
        
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </div>
    </form>
</div>

</body>
</html>
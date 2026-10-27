<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Housekeeper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .card { border: none; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05); border-radius: 0.75rem; }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5" style="max-width: 700px;">
        <div class="mb-4">
            <a href="{{ route('housekeepers.index') }}" class="text-decoration-none text-muted">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
            <h3 class="fw-bold text-dark mt-2">Tambah Housekeeper Baru</h3>
            <p class="text-muted">Masukkan informasi lengkap profil staff pengelola kebersihan kos.</p>
        </div>

        <div class="card p-4">
            <form action="{{ route('housekeepers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama staff..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="nomor_telepon" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat domisili staff..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tugas Harian</label>
                    <input type="text" name="tugas_harian" class="form-control" placeholder="Contoh: Menyapu, Mengepel, Membersihkan Toilet" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Area Penanganan</label>
                    <input type="text" name="area_penanganan" class="form-control" placeholder="Contoh: Lantai 1 & Area Parkir" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Status Keaktifan</label>
                    <select name="status" class="form-select" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Cuti">Cuti</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('housekeepers.index') }}" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Housekeeper / Staff Kos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
        }
        .table th {
            font-weight: 600;
            background-color: #f1f3f5;
            color: #495057;
        }
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-building-user me-2"></i>Kos Management System</a>
        </div>
    </nav>

    <div class="container">
        <!-- Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold text-dark mb-1">Daftar Housekeeper / Staff[cite: 1]</h3>
                <p class="text-muted mb-0">Kelola profil penjaga, tugas harian, dan area penanganan kos[cite: 1].</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="{{ route('housekeepers.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Housekeeper Baru
                </a>
            </div>
        </div>

        <!-- Alert Notification -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table Card -->
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Nama Staff</th>
                                <th>Kontak</th>
                                <th>Tugas Harian</th>
                                <th>Area Penanganan</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($housekeepers as $index => $item)
                            <tr>
                                <td class="ps-4 fw-semibold text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->nama }}</div>
                                    <small class="text-muted">{{ Str::limit($item->alamat, 30) }}</small>
                                </td>
                                <td>
                                    <i class="fa-solid fa-phone text-muted me-1"></i> {{ $item->nomor_telepon }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $item->tugas_harian }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $item->area_penanganan }}</span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($item->status) {
                                            'Aktif' => 'bg-success-subtle text-success',
                                            'Cuti' => 'bg-warning-subtle text-warning',
                                            default => 'bg-secondary-subtle text-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }} px-2 py-1">{{ $item->status }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('housekeepers.edit', $item->id) }}" class="btn btn-warning btn-action text-white" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('housekeepers.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-regular fa-folder-open fa-2x mb-2"></i>
                                    <p class="mb-0">Belum ada data housekeeper yang tersimpan.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
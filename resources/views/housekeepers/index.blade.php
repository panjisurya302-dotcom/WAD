@extends('layouts.app')

@section('title', 'Daftar Housekeeper - Kos Management')

@section('content')
<div class="container-xl">
    <!-- Breadcrumb & Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <div class="breadcrumb-custom">
                <a href="{{ route('housekeepers.index') }}"><i class="fa-solid fa-house-chimney me-1"></i> Dashboard</a>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <span>Housekeeper</span>
            </div>
            <h1 class="page-title">Manajemen Housekeeper</h1>
            <p class="page-subtitle mb-0">Pantau ketersediaan, tugas harian, dan pembagian area kerja staf kos secara terpusat.</p>
        </div>
        <div>
            <a href="{{ route('housekeepers.create') }}" class="btn-primary-custom">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Housekeeper Baru</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert-custom alert-custom-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                <span class="fw-medium">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- KPI Metric Summary Cards -->
    @php
        $totalStaff = $housekeepers->count();
        $aktifStaff = $housekeepers->where('status', 'Aktif')->count();
        $cutiStaff = $housekeepers->where('status', 'Cuti')->count();
        $nonaktifStaff = $housekeepers->where('status', 'Nonaktif')->count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Total Housekeeper</div>
                    <div class="stat-value">{{ $totalStaff }}</div>
                    <div class="stat-hint"><i class="fa-solid fa-users me-1 text-primary"></i> Seluruh staf terdaftar</div>
                </div>
                <div class="stat-icon-wrapper stat-icon-blue">
                    <i class="fa-solid fa-id-card"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Staf Aktif</div>
                    <div class="stat-value text-success">{{ $aktifStaff }}</div>
                    <div class="stat-hint"><i class="fa-solid fa-circle-dot me-1 text-success"></i> Siap bertugas hari ini</div>
                </div>
                <div class="stat-icon-wrapper stat-icon-green">
                    <i class="fa-solid fa-user-check"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Sedang Cuti</div>
                    <div class="stat-value text-warning">{{ $cutiStaff }}</div>
                    <div class="stat-hint"><i class="fa-solid fa-clock me-1 text-warning"></i> Izin sementara</div>
                </div>
                <div class="stat-icon-wrapper stat-icon-amber">
                    <i class="fa-solid fa-calendar-xmark"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Nonaktif</div>
                    <div class="stat-value text-secondary">{{ $nonaktifStaff }}</div>
                    <div class="stat-hint"><i class="fa-solid fa-pause me-1 text-secondary"></i> Tidak bertugas</div>
                </div>
                <div class="stat-icon-wrapper stat-icon-slate">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Data Card -->
    <div class="custom-card">
        <!-- Card Toolbar: Search & Status Filters -->
        <div class="custom-card-header">
            <div class="filter-tab-group" id="statusFilterTabs">
                <button type="button" class="filter-tab-btn active" data-filter="all">Semua ({{ $totalStaff }})</button>
                <button type="button" class="filter-tab-btn" data-filter="Aktif">Aktif ({{ $aktifStaff }})</button>
                <button type="button" class="filter-tab-btn" data-filter="Cuti">Cuti ({{ $cutiStaff }})</button>
                <button type="button" class="filter-tab-btn" data-filter="Nonaktif">Nonaktif ({{ $nonaktifStaff }})</button>
            </div>

            <div class="search-input-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="staffSearchInput" class="form-control" placeholder="Cari nama, tugas, atau telepon...">
            </div>
        </div>

        <!-- Table View -->
        <div class="table-responsive">
            <table class="custom-table" id="housekeeperTable">
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th>Profil Staff</th>
                        <th>Kontak Telepon</th>
                        <th>Tugas Harian</th>
                        <th>Area Penanganan</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($housekeepers as $index => $item)
                        @php
                            // Initials generation
                            $words = explode(' ', trim($item->nama));
                            $initials = '';
                            foreach (array_slice($words, 0, 2) as $w) {
                                $initials .= strtoupper(substr($w, 0, 1));
                            }
                            $initials = $initials ?: 'HK';

                            // Clean phone number for WhatsApp
                            $cleanPhone = preg_replace('/[^0-9]/', '', $item->nomor_telepon);
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }

                            // Status Pill Styling
                            $statusSlug = match($item->status) {
                                'Aktif' => 'status-aktif',
                                'Cuti' => 'status-cuti',
                                default => 'status-nonaktif'
                            };
                        @endphp
                        <tr class="staff-row" data-status="{{ $item->status }}">
                            <td class="text-center text-muted fw-semibold row-number">{{ $index + 1 }}</td>
                            <td>
                                <div class="staff-profile-cell">
                                    <div class="staff-initials-avatar">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <a href="{{ route('housekeepers.show', $item->id) }}" class="staff-name search-target-name text-decoration-none">
                                            {{ $item->nama }}
                                        </a>
                                        <div class="staff-address">
                                            <i class="fa-solid fa-location-dot text-danger opacity-75"></i>
                                            <span>{{ Str::limit($item->alamat, 45) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-cell">
                                    <span class="contact-number search-target-phone">{{ $item->nomor_telepon }}</span>
                                    @if(!empty($cleanPhone))
                                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" class="wa-link" title="Kirim Pesan WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="tag-duty search-target-duty">
                                    <i class="fa-solid fa-broom text-primary opacity-75"></i>
                                    <span>{{ $item->tugas_harian }}</span>
                                </span>
                            </td>
                            <td>
                                <span class="tag-area search-target-area">
                                    <i class="fa-solid fa-map-pin text-purple opacity-75"></i>
                                    <span>{{ $item->area_penanganan }}</span>
                                </span>
                            </td>
                            <td>
                                <span class="status-pill {{ $statusSlug }}">
                                    <span class="status-pill-dot"></span>
                                    <span>{{ $item->status }}</span>
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="action-buttons-group">
                                    <a href="{{ route('housekeepers.show', $item->id) }}" class="btn-action-view" title="Lihat Profil">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="{{ route('housekeepers.edit', $item->id) }}" class="btn-action-edit" title="Sunting Data">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('housekeepers.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($item->nama) }}? Data yang dihapus tidak dapat dipulihkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus Data">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state-card">
                                    <div class="empty-state-icon">
                                        <i class="fa-solid fa-users-slash"></i>
                                    </div>
                                    <h5 class="empty-state-title">Belum Ada Data Housekeeper</h5>
                                    <p class="empty-state-description">Data staf kebersihan dan penanggung jawab kos belum tersedia. Mulai dengan menambahkan staf baru.</p>
                                    <a href="{{ route('housekeepers.create') }}" class="btn-primary-custom">
                                        <i class="fa-solid fa-plus"></i>
                                        <span>Tambah Housekeeper Pertama</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- No Matching Filter Message (Dynamic) -->
        <div id="noMatchMessage" class="empty-state-card d-none">
            <div class="empty-state-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <h5 class="empty-state-title">Tidak Ada Hasil Ditemukan</h5>
            <p class="empty-state-description">Tidak ditemukan data housekeeper yang cocok dengan kata kunci atau filter yang Anda pilih.</p>
            <button type="button" class="btn-secondary-custom" onclick="resetFilters()">
                <i class="fa-solid fa-rotate-left"></i>
                <span>Reset Pencarian</span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('staffSearchInput');
        const filterBtns = document.querySelectorAll('.filter-tab-btn');
        const rows = document.querySelectorAll('.staff-row');
        const noMatchMsg = document.getElementById('noMatchMessage');
        const table = document.getElementById('housekeeperTable');

        let currentFilter = 'all';
        let searchQuery = '';

        function filterTable() {
            let visibleCount = 0;

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const name = row.querySelector('.search-target-name')?.textContent.toLowerCase() || '';
                const phone = row.querySelector('.search-target-phone')?.textContent.toLowerCase() || '';
                const duty = row.querySelector('.search-target-duty')?.textContent.toLowerCase() || '';
                const area = row.querySelector('.search-target-area')?.textContent.toLowerCase() || '';

                const matchesStatus = (currentFilter === 'all' || rowStatus === currentFilter);
                const matchesSearch = !searchQuery || 
                                      name.includes(searchQuery) || 
                                      phone.includes(searchQuery) || 
                                      duty.includes(searchQuery) || 
                                      area.includes(searchQuery);

                if (matchesStatus && matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (rows.length > 0) {
                if (visibleCount === 0) {
                    noMatchMsg.classList.remove('d-none');
                    table.classList.add('d-none');
                } else {
                    noMatchMsg.classList.add('d-none');
                    table.classList.remove('d-none');
                }
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', function (e) {
                searchQuery = e.target.value.trim().toLowerCase();
                filterTable();
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.getAttribute('data-filter');
                filterTable();
            });
        });

        window.resetFilters = function () {
            if (searchInput) searchInput.value = '';
            searchQuery = '';
            currentFilter = 'all';
            filterBtns.forEach(b => {
                if (b.getAttribute('data-filter') === 'all') {
                    b.classList.add('active');
                } else {
                    b.classList.remove('active');
                }
            });
            filterTable();
        };
    });
</script>
@endpush

@extends('layouts.app')

@section('title', 'Detail Housekeeper - ' . $housekeeper->nama)

@section('content')
<div class="container-xl">
    <div style="max-width: 860px; margin: 0 auto;">
        <!-- Breadcrumb & Header -->
        <div class="mb-4">
            <div class="breadcrumb-custom">
                <a href="{{ route('housekeepers.index') }}"><i class="fa-solid fa-house-chimney me-1"></i> Dashboard</a>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <a href="{{ route('housekeepers.index') }}">Housekeeper</a>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <span>Detail Profil</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-title">Rincian Profil Staf</h1>
                    <p class="page-subtitle mb-0">Informasi lengkap data diri, operasional kerja, dan area tugas kos.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('housekeepers.index') }}" class="btn-secondary-custom">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('housekeepers.edit', $housekeeper->id) }}" class="btn-primary-custom">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Sunting Data</span>
                    </a>
                </div>
            </div>
        </div>

        @php
            // Initials generation
            $words = explode(' ', trim($housekeeper->nama));
            $initials = '';
            foreach (array_slice($words, 0, 2) as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            $initials = $initials ?: 'HK';

            // WhatsApp link
            $cleanPhone = preg_replace('/[^0-9]/', '', $housekeeper->nomor_telepon);
            if (str_starts_with($cleanPhone, '0')) {
                $cleanPhone = '62' . substr($cleanPhone, 1);
            }

            // Status Slug
            $statusSlug = match($housekeeper->status) {
                'Aktif' => 'status-aktif',
                'Cuti' => 'status-cuti',
                default => 'status-nonaktif'
            };
        @endphp

        <!-- Profile Hero Card -->
        <div class="custom-card mb-4">
            <div class="p-4 p-md-5">
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 pb-4 mb-4 border-bottom">
                    <div class="d-flex align-items-center gap-3">
                        <div class="staff-initials-avatar" style="width: 64px; height: 64px; font-size: 1.5rem;">
                            {{ $initials }}
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.02em;">{{ $housekeeper->nama }}</h3>
                                <span class="status-pill {{ $statusSlug }}">
                                    <span class="status-pill-dot"></span>
                                    <span>{{ $housekeeper->status }}</span>
                                </span>
                            </div>
                            <div class="text-muted small">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i> Terdaftar sejak {{ $housekeeper->created_at ? $housekeeper->created_at->format('d M Y') : 'Baru' }}
                            </div>
                        </div>
                    </div>

                    @if(!empty($cleanPhone))
                        <div>
                            <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success px-3 py-2 fw-medium d-inline-flex align-items-center gap-2">
                                <i class="fa-brands fa-whatsapp fs-5"></i>
                                <span>Hubungi via WhatsApp</span>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Detail Grid -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold mb-1">Nomor Kontak / Telepon</div>
                        <div class="fs-5 fw-semibold text-dark">{{ $housekeeper->nomor_telepon }}</div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold mb-1">Status Keaktifan</div>
                        <div class="fs-5 fw-semibold text-dark">{{ $housekeeper->status }} Bertugas</div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold mb-1">Tugas Harian</div>
                        <div class="fs-6 text-dark bg-light p-3 rounded-3 border">
                            <i class="fa-solid fa-broom text-primary me-2"></i>
                            {{ $housekeeper->tugas_harian }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold mb-1">Area Penanganan Kos</div>
                        <div class="fs-6 text-dark bg-light p-3 rounded-3 border">
                            <i class="fa-solid fa-map-pin text-danger me-2"></i>
                            {{ $housekeeper->area_penanganan }}
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-muted small text-uppercase fw-semibold mb-1">Alamat Domisili</div>
                        <div class="fs-6 text-dark bg-light p-3 rounded-3 border">
                            <i class="fa-solid fa-location-dot text-secondary me-2"></i>
                            {{ $housekeeper->alamat }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="p-4 bg-light bg-opacity-50 border-top d-flex align-items-center justify-content-between">
                <form action="{{ route('housekeepers.destroy', $housekeeper->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($housekeeper->nama) }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                        <i class="fa-solid fa-trash-can me-1"></i> Hapus Staf Ini
                    </button>
                </form>

                <a href="{{ route('housekeepers.edit', $housekeeper->id) }}" class="btn-primary-custom">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Sunting Data</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Tambah Housekeeper - Kos Management')

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
                <span>Tambah Baru</span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="page-title">Tambah Housekeeper Baru</h1>
                    <p class="page-subtitle mb-0">Daftarkan profil staf untuk mengelola kebersihan dan operasional fasilitas kos.</p>
                </div>
                <a href="{{ route('housekeepers.index') }}" class="btn-secondary-custom d-none d-sm-inline-flex">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- Validation Errors Alert -->
        @if($errors->any())
            <div class="alert-custom alert-custom-danger alert-dismissible fade show" role="alert">
                <div>
                    <div class="fw-semibold mb-1"><i class="fa-solid fa-circle-exclamation me-2"></i>Terdapat kesalahan pengisian data:</div>
                    <ul class="mb-0 ps-3 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="custom-card">
            <form action="{{ route('housekeepers.store') }}" method="POST">
                @csrf
                <div class="p-4 p-md-5">
                    <!-- Section 1: Profil & Identitas -->
                    <div class="mb-5">
                        <div class="form-section-title">
                            <i class="fa-regular fa-id-card"></i>
                            <span>1. Informasi Identitas & Kontak</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Nama Lengkap <span class="required-mark">*</span>
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       class="form-control-custom" 
                                       value="{{ old('nama') }}" 
                                       placeholder="misal: Budi Santoso" 
                                       required 
                                       autofocus>
                                <div class="form-hint">Nama lengkap staf sesuai KTP atau identitas resmi.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Nomor Telepon / WhatsApp <span class="required-mark">*</span>
                                </label>
                                <input type="text" 
                                       name="nomor_telepon" 
                                       class="form-control-custom" 
                                       value="{{ old('nomor_telepon') }}" 
                                       placeholder="misal: 081234567890" 
                                       required>
                                <div class="form-hint">Digunakan untuk komunikasi langsung dan koordinasi kerja.</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">
                                    Alamat Domisili <span class="required-mark">*</span>
                                </label>
                                <textarea name="alamat" 
                                          class="form-control-custom" 
                                          rows="3" 
                                          placeholder="Tuliskan alamat tempat tinggal atau domisili staf..." 
                                          required>{{ old('alamat') }}</textarea>
                                <div class="form-hint">Cantumkan alamat jelas domisili staf saat ini.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Penugasan & Operasional -->
                    <div class="mb-4">
                        <div class="form-section-title">
                            <i class="fa-solid fa-briefcase"></i>
                            <span>2. Penugasan & Status Kerja</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tugas Harian <span class="required-mark">*</span>
                                </label>
                                <input type="text" 
                                       name="tugas_harian" 
                                       class="form-control-custom" 
                                       value="{{ old('tugas_harian') }}" 
                                       placeholder="misal: Menyapu, mengepel, cuci sprei" 
                                       required>
                                <div class="form-hint">Rincian tanggung jawab kebersihan harian.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Area Penanganan <span class="required-mark">*</span>
                                </label>
                                <input type="text" 
                                       name="area_penanganan" 
                                       class="form-control-custom" 
                                       value="{{ old('area_penanganan') }}" 
                                       placeholder="misal: Lantai 1 & Area Parkir Kos" 
                                       required>
                                <div class="form-hint">Zona atau lantai yang menjadi area tanggung jawab.</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">
                                    Status Keaktifan <span class="required-mark">*</span>
                                </label>
                                <div class="status-radio-grid">
                                    <label class="status-radio-card active-aktif" id="card-Aktif">
                                        <input type="radio" name="status" value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'checked' : '' }} onchange="updateRadioSelection(this)">
                                        <span class="status-pill-dot" style="background-color: var(--status-aktif-dot);"></span>
                                        <div>
                                            <div class="fw-semibold text-dark small">Aktif Bertugas</div>
                                            <div class="text-muted" style="font-size: 0.725rem;">Siap bertugas normal</div>
                                        </div>
                                    </label>

                                    <label class="status-radio-card" id="card-Cuti">
                                        <input type="radio" name="status" value="Cuti" {{ old('status') == 'Cuti' ? 'checked' : '' }} onchange="updateRadioSelection(this)">
                                        <span class="status-pill-dot" style="background-color: var(--status-cuti-dot);"></span>
                                        <div>
                                            <div class="fw-semibold text-dark small">Sedang Cuti</div>
                                            <div class="text-muted" style="font-size: 0.725rem;">Izin sementara</div>
                                        </div>
                                    </label>

                                    <label class="status-radio-card" id="card-Nonaktif">
                                        <input type="radio" name="status" value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'checked' : '' }} onchange="updateRadioSelection(this)">
                                        <span class="status-pill-dot" style="background-color: var(--status-nonaktif-dot);"></span>
                                        <div>
                                            <div class="fw-semibold text-dark small">Nonaktif</div>
                                            <div class="text-muted" style="font-size: 0.725rem;">Berhenti / Tidak aktif</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="p-4 bg-light bg-opacity-50 border-top d-flex align-items-center justify-content-between">
                    <a href="{{ route('housekeepers.index') }}" class="btn-secondary-custom">
                        <i class="fa-solid fa-xmark"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        <i class="fa-solid fa-check"></i>
                        <span>Simpan Data Housekeeper</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateRadioSelection(radio) {
        document.querySelectorAll('.status-radio-card').forEach(card => {
            card.classList.remove('active-aktif', 'active-cuti', 'active-nonaktif');
        });
        const parentCard = radio.closest('.status-radio-card');
        if (radio.value === 'Aktif') parentCard.classList.add('active-aktif');
        if (radio.value === 'Cuti') parentCard.classList.add('active-cuti');
        if (radio.value === 'Nonaktif') parentCard.classList.add('active-nonaktif');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const checkedRadio = document.querySelector('input[name="status"]:checked');
        if (checkedRadio) updateRadioSelection(checkedRadio);
    });
</script>
@endpush

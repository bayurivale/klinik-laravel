@extends('layouts.app')

@section('content')

{{-- HERO --}}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card bg-gradient-primary text-white shadow-lg">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1 font-weight-bold">
                        Selamat Datang, {{ $pelanggan->nama ?? auth()->user()->name }}
                    </h2>
                    <p class="mb-0 opacity-75">
                        memberikan kemudahan layanan klinik berbasis teknologi all-in-one dalam satu tempat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STATS --}}
<div class="row mb-4">

    {{-- OBAT --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-left-primary">
            <div class="card-body">
                <p class="text-muted mb-1">Obat Tersedia</p>
                <h2 class="font-weight-bold">{{ $jumlahObat }}</h2>
            </div>
        </div>
    </div>

    {{-- TOTAL PEMBELIAN --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-left-success">
            <div class="card-body">
                <p class="text-muted mb-1">Total Pembelian</p>
                <h2 class="font-weight-bold">{{ $totalPembelian }}</h2>
            </div>
        </div>
    </div>

    {{-- MENUNGGU BAYAR --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-left-warning">
            <div class="card-body">
                <p class="text-muted mb-1">Menunggu Pembayaran</p>
                <h2 class="font-weight-bold">{{ $menungguPembayaran }}</h2>
            </div>
        </div>
    </div>

    {{-- 💎 TOTAL BELANJA (INI YANG BARU) --}}
    <div class="col-md-3">
        <div class="card shadow-lg bg-dark text-white">
            <div class="card-body">
                <p class="opacity-75 mb-1">Total Belanja Anda</p>
                <h2 class="font-weight-bold">
                    Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                </h2>
            </div>
        </div>
    </div>

</div>


{{-- QUICK ACTION --}}
<div class="row mb-4">
    <div class="col-md-12">
        <h5 class="mb-3 font-weight-bold">Aksi Cepat</h5>
    </div>

    <div class="col-md-6 mb-3">
        <a href="{{ route('pelanggan.obat.index') }}"
           class="card text-decoration-none shadow-sm hover-shadow">
            <div class="card-body d-flex align-items-center">
                <i class="fa fa-medkit fa-2x text-primary mr-3"></i>
                <div>
                    <h6 class="mb-0 font-weight-bold">Beli Obat</h6>
                    <small class="text-muted">Cari & pesan obat dengan cepat</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 mb-3">
        <a href="{{ route('pelanggan.pembayaran.index') }}"
           class="card text-decoration-none shadow-sm">
            <div class="card-body d-flex align-items-center">
                <i class="fa fa-credit-card fa-2x text-success mr-3"></i>
                <div>
                    <h6 class="mb-0 font-weight-bold">Pembayaran</h6>
                    <small class="text-muted">Pantau status pembayaran Anda</small>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- FOOTER INFO --}}
<div class="row">
    <div class="col-md-12">
        <div class="card bg-light">
            <div class="card-body text-center">
                <small class="text-muted">
                    ©2025-2026 <b>PT Mahasiswa unikom.copyrigt tubes</b> 💎
                </small>
            </div>
        </div>
    </div>
</div>

@endsection

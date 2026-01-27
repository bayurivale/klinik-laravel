@extends('layouts.app')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="head d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">List Transaksi Menunggu Pembayaran</h4>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->pelanggan->nama }}</td>
                        <td>{{ $t->obat->nama_obat }}</td>
                        <td>{{ $t->jumlah }}</td>
                        <td>Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = $t->status_transaksi;

                                // default badge
                                $badge = 'badge-gradient-secondary';

                                if ($status == 'selesai') {
                                $badge = 'badge-gradient-success';
                                } elseif ($status == 'menunggu_pembayaran') {
                                $badge = 'badge-gradient-danger';
                                } elseif ($status == 'menunggu_verifikasi') {
                                $badge = 'badge-gradient-warning';
                                } elseif ($status == 'ditolak') {
                                $badge = 'badge-gradient-danger';
                                }
                            @endphp

                            <label class="badge {{ $badge }}">
                                {{ strtoupper(str_replace('_', ' ', $status)) }}
                            </label>
                        </td>

                        <td>{{ $t->tanggal_transaksi }}</td>
                        <td>
                            <a href="{{ route('transaksi.verifikasi', $t->id) }}" class="btn btn-primary btn-sm">
                                Verifikasi
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            <i class="fa fa-info-circle"></i> Data masih kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="head d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Verifikasi Transaksi</h4>
            </div>

            <!-- DATA TRANSAKSI -->
            <div class="mb-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Obat</th>
                        <td>{{ $transaksi->obat->nama_obat }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pembeli</th>
                        <td>{{ $transaksi->pelanggan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $transaksi->jumlah }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp {{ number_format($transaksi->obat->harga_obat, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Bayar</th>
                        <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <form action="{{ route('transaksi.verifikasi.update', $transaksi->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Status</label>
                    <select name="status_transaksi" class="form-control">
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <button class="btn btn-success mt-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

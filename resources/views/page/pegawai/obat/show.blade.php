@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail Obat</h4>
    </div>

    <div class="card-body">

        {{-- FOTO OBAT --}}
        @if($obat->foto)
            <div class="mb-3 text-center">
                <img src="{{ asset('storage/obat/'.$obat->foto) }}"
                     alt="Foto Obat"
                     class="img-thumbnail"
                     style="max-width: 200px;">
            </div>
        @else
            <p><em>Foto belum tersedia</em></p>
        @endif

        {{-- DATA OBAT --}}
        <table class="table">
            <tr>
                <th>Nama Obat</th>
                <td>{{ $obat->nama_obat }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $obat->kategori_obat }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>{{ $obat->harga_obat }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $obat->stok_obat }}</td>
            </tr>
            <tr>
                <th>Tanggal Expired</th>
                <td>{{ $obat->tanggal_exp }}</td>
            </tr>
        </table>

        <a href="{{ route('obat.index') }}" class="btn btn-secondary btn-sm mt-3">
            Kembali
        </a>
    </div>
</div>
@endsection

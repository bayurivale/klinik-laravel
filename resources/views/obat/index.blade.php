@extends('layouts.app')
@section('content')
<a href="{{ route('obat.create') }}">Tambah Obat</a>

<table>
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach($obat as $o)
    <tr>
        <td>{{ $o->nama_obat }}</td>
        <td>{{ $o->kategori_obat }}</td>
        <td>{{ $o->harga_obat }}</td>
        <td>{{ $o->stok_obat }}</td>
        <td>
            <a href="{{ route('obat.edit', $o->id) }}">Edit</a>
            <form action="{{ route('obat.destroy', $o->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

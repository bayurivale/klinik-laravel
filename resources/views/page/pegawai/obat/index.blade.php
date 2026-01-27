@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="head d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Table Obat</h4>
                @if(auth()->user()->role === 'pegawai')
                    <a href="{{ route('obat.create') }}" class="btn btn-primary btn-sm">
                        Tambah Obat
                    </a>
                @endif
            </div>
            <table class="table table-striped">
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>

                @forelse($obat as $o)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $o->nama_obat }}</td>
                    <td>{{ $o->kategori_obat }}</td>
                    <td>Rp {{ number_format($o->harga_obat, 0, ',', '.') }}</td>
                    <td>{{ $o->stok_obat }}</td>
                    <td>
                        <a href="{{ route('obat.show', $o->id) }}" 
                        class="btn btn-info btn-sm"
                        title="Detail">
                            <i class="fa fa-eye"></i>
                        </a>

                        @if(auth()->user()->role === 'pegawai')
                            {{-- EDIT --}}
                            <a href="{{ route('obat.edit', $o->id) }}" 
                            class="btn btn-warning btn-sm"
                            title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('obat.destroy', $o->id) }}"
                                method="POST"
                                class="d-inline delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn btn-danger btn-sm btn-delete"
                                        title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            <i class="fa fa-info-circle"></i> Data masih kosong
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection

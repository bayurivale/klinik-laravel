@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Obat</h4>
    
        <form action="{{ route('obat.update', $obat->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <div class="mb-3">
                <label>Nama Obat</label>
                <input type="text"
                       name="nama_obat"
                       class="form-control"
                       value="{{ $obat->nama_obat }}"
                       required>
            </div>
    
            <div class="mb-3">
                <label>Kategori Obat</label>
                <input type="text"
                       name="kategori_obat"
                       class="form-control"
                       value="{{ $obat->kategori_obat }}"
                       required>
            </div>
    
            <div class="mb-3">
                <label>Harga Obat</label>
                <input type="number"
                       name="harga_obat"
                       class="form-control"
                       value="{{ $obat->harga_obat }}"
                       required>
            </div>
    
            <div class="mb-3">
                <label>Stok Obat</label>
                <input type="number"
                       name="stok_obat"
                       class="form-control"
                       value="{{ $obat->stok_obat }}"
                       required>
            </div>
    
            <div class="mb-3">
                <label>Tanggal Expired</label>
                <input type="date"
                       name="tanggal_exp"
                       class="form-control"
                       value="{{ $obat->tanggal_exp }}"
                       required>
            </div>
    
            {{-- FOTO OBAT --}}
            <div class="mb-3">
                <label>Foto Obat</label>
                <input type="file"
                       name="foto"
                       class="form-control"
                       accept="image/*">
                       <div class="text-mute">
                           <small>Kosongkan jika tidak ingin mengubah foto</small>
                       </div>
            </div>
    
            {{-- Preview foto lama --}}
            @if($obat->foto)
                <div class="mb-3">
                    <img src="{{ asset('storage/obat/'.$obat->foto) }}"
                         alt="Foto Obat"
                         class="img-thumbnail"
                         style="max-width: 200px;">
                </div>
            @endif
    
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>
    
            <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection

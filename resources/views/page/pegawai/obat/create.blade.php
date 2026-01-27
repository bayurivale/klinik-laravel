@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Obat</h4>

    <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Kategori Obat</label>
        <input type="text" name="kategori_obat" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Harga Obat</label>
        <input type="number" name="harga_obat" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Stok Obat</label>
        <input type="number" name="stok_obat" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Tanggal Expired</label>
        <input type="date" name="tanggal_exp" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Foto Obat</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn btn-primary">
        Simpan
      </button>
    </form>
  </div>
</div>
@endsection

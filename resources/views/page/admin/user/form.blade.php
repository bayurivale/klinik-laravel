@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah User</h4>

    <form action="{{ route('user.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">
        Simpan
      </button>
    </form>
  </div>
</div>
@endsection

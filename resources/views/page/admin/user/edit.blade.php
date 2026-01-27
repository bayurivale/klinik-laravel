@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h4>
            </div>

            <div class="card-body">
                <form
                    action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                    method="POST">

                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $user->email ?? '' }}"
                               required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ $user->username ?? '' }}"
                               required>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               @if(!isset($user))
                                   required
                               @endif
                               placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin ganti password' : '' }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($user) ? 'Update' : 'Simpan' }}
                    </button>

                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
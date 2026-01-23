@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail User</h4>
    </div>

    <div class="card-body">
        <table class="table">
            <tr>
                <th>Username</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>
        </table>

        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>
@endsection

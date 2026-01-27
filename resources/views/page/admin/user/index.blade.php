@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="head d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">Table User</h4>
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah User</a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th> No </th>
                    <th> Email </th>
                    <th> Username </th>
                    <th> Dibuat </th>
                    <th> Aksi </th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="py-1">{{ $loop->iteration }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td class="text-center">
                            <!-- DETAIL -->
                            <a href="{{ route('user.show', $user->id) }}"
                            class="btn btn-info btn-sm"
                            title="Detail">
                                <i class="fa fa-eye"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('user.edit', $user->id) }}"
                            class="btn btn-warning btn-sm"
                            title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('user.destroy', $user->id) }}"
                                method="POST"
                                class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
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
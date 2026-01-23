<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('page.admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('page.admin.user.form');
    }
    public function store(Request $request)
    {
          User::create([
        'username' => $request->input('username'),
        'email'    => $request->input('email'),
        'password' => $request->input('password'), // auto-hash
    ]);

    return redirect()->route('user.index')
        ->with('success', 'User berhasil ditambahkan');
    }
    public function show(User $user)
    {
        return view('page.admin.user.show', compact('user'));
    }
    public function edit(User $user)
    {
        return view('page.admin.user.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $user->update([
            'email' => $request->email,
            'username' => $request->username,
        ]);
        return redirect()->route('user.index')
        ->with('success', 'User berhasil diupdate');
    }
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}

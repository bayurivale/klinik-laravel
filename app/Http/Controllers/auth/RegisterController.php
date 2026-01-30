<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', 
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'id_user'        => $user->id,
            'nama'           => $request->username,
            'alamat'         => $request->alamat,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'no_telepon'     => $request->no_telepon,
        ]);

        Auth::login($user);

        return redirect()->route('pelanggan.dashboard');

    }
}

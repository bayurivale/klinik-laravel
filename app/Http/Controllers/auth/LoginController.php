<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // 2. Tentukan apakah login pakai email atau username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        // 3. Coba login
        if (Auth::attempt([
            $loginType => $request->login,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'pegawai') {
                return redirect()->route('pegawai.dashboard');
            }

            return redirect()->route('pelanggan.dashboard');
        }

        // 5. Jika gagal login
        return back()->withErrors([
            'login' => 'Username / Email atau Password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    // ===============================
    // LOGIN MANUAL
    // ===============================
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

            // redirect sesuai role
            $role = auth()->user()->role;
            if ($role === 'admin') return redirect()->route('admin.dashboard');
            if ($role === 'pegawai') return redirect()->route('pegawai.dashboard');
            return redirect()->route('pelanggan.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username / Email atau Password salah'
        ]);
    }

    // ===============================
    // LOGIN GOOGLE
    // ===============================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt($googleUser->getPassword()),
                'role' => 'pelanggan',
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }

    // ===============================
    // REDIRECT BERDASARKAN ROLE
    // ===============================
    private function redirectByRole($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'pegawai') {
            return redirect()->route('pegawai.dashboard');
        }

        return redirect()->route('pelanggan.dashboard');
    }

    // ===============================
    // LOGOUT
    // ===============================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

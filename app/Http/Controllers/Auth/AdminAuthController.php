<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 🔥 AMBIL USER + CEK ROLE ADMIN
        $user = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        // ❌ kalau tidak ditemukan
        if (!$user) {
            return back()->withErrors([
                'email' => 'Akun admin tidak ditemukan.',
            ])->withInput();
        }

        // ❌ cek password manual
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        // ✅ login pakai guard admin
        Auth::guard('admin')->login($user, $request->filled('remember'));

        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Selamat datang Administrator ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah keluar dari panel admin.');
    }
}
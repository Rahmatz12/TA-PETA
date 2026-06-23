<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $laporanCount = Laporan::where('user_id', $user->id)->count();
        $daysJoined = now()->diffInDays($user->created_at);

        return view('masyarakat.profil', compact('user', 'laporanCount', 'daysJoined'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password saat ini tidak cocok.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profil.index')->with('success', 'Password berhasil diubah!');
    }
}

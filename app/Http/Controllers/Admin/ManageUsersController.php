<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUsersController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'masyarakat');
        $search = $request->get('search');

        $masyarakats = User::query();
        $admins = Admin::query();

        if ($search) {
            $masyarakats->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
            $admins->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        $masyarakats = $masyarakats->orderBy('created_at', 'desc')->paginate(10, ['*'], 'masyarakat_page');
        $admins = $admins->orderBy('created_at', 'desc')->paginate(10, ['*'], 'admin_page');

        return view('admin.manage-users', compact('masyarakats', 'admins', 'tab', 'search'));
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,petugas',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('admin.users.index', ['tab' => 'admin'])->with('success', 'Admin/Petugas berhasil ditambahkan!');
    }

    public function destroyAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.users.index', ['tab' => 'admin'])->with('success', 'Admin/Petugas berhasil dihapus!');
    }

    public function destroyMasyarakat($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index', ['tab' => 'masyarakat'])->with('success', 'Masyarakat berhasil dihapus!');
    }
}

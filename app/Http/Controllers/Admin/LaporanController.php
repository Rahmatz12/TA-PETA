<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_laporan', 'like', "%$search%")
                  ->orWhere('nama_pelapor', 'like', "%$search%")
                  ->orWhere('nama_saluran', 'like', "%$search%");
            });
        }

        $laporans = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $stats = [
            'total' => Laporan::count(),
            'menunggu' => Laporan::where('status', 'menunggu')->count(),
            'diverifikasi' => Laporan::where('status', 'diverifikasi')->count(),
            'diproses' => Laporan::where('status', 'diproses')->count(),
            'selesai' => Laporan::where('status', 'selesai')->count(),
            'ditolak' => Laporan::where('status', 'ditolak')->count(),
        ];

        return view('admin.laporan', compact('laporans', 'stats'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan-detail', compact('laporan'));
    }

    public function verifikasi(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => 'diverifikasi',
            'catatan_verifikasi' => $request->catatan,
            'tanggal_verifikasi' => now(),
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diverifikasi!');
    }

    public function proses(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => 'diproses',
            'tanggal_proses' => now(),
            'estimasi_perbaikan' => $request->estimasi,
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan sedang diproses!');
    }

    public function selesai(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => 'selesai',
            'tanggal_selesai' => now(),
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan telah diselesaikan!');
    }

    public function tolak(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => 'ditolak',
            'catatan_verifikasi' => $request->catatan,
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan telah ditolak!');
    }
}

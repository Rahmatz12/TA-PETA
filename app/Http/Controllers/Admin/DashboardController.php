<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Laporan;
use App\Models\Saluran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_saluran' => Saluran::count(),
            'total_laporan' => Laporan::count(),
            'total_masyarakat' => User::count(),
            'total_admin' => Admin::count(),
            'laporan_menunggu' => Laporan::where('status', 'menunggu')->count(),
            'laporan_diproses' => Laporan::where('status', 'diproses')->count(),
            'laporan_selesai' => Laporan::where('status', 'selesai')->count(),
            'laporan_ditolak' => Laporan::where('status', 'ditolak')->count(),
        ];

        $kondisiStats = [
            'baik' => Saluran::where('kondisi', 'baik')->count(),
            'perbaikan' => Saluran::where('kondisi', 'perbaikan')->count(),
            'rusak_ringan' => Saluran::where('kondisi', 'rusak-ringan')->count(),
            'rusak_sedang' => Saluran::where('kondisi', 'rusak-sedang')->count(),
            'rusak_berat' => Saluran::where('kondisi', 'rusak-berat')->count(),
        ];

        $recentLaporans = Laporan::orderBy('created_at', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        $jenisStats = [
            'primer' => Saluran::where('jenis', 'primer')->count(),
            'sekunder' => Saluran::where('jenis', 'sekunder')->count(),
            'tersier' => Saluran::where('jenis', 'tersier')->count(),
            'pintu' => Saluran::where('jenis', 'pintu')->count(),
            'bendungan' => Saluran::where('jenis', 'bendungan')->count(),
        ];

        return view('admin.dashboard', compact('stats', 'kondisiStats', 'recentLaporans', 'recentUsers', 'jenisStats'));
    }
}

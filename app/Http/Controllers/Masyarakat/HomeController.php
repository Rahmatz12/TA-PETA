<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Saluran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalSaluran = Saluran::count();
        $saluranAktif = Saluran::where('status', 'aktif')->count();
        $saluranBaik = Saluran::where('kondisi', 'baik')->count();
        $saluranRusak = Saluran::whereIn('kondisi', ['rusak-ringan', 'rusak-sedang', 'rusak-berat'])->count();

        $categories = [
            'primer' => Saluran::where('jenis', 'primer')->count(),
            'sekunder' => Saluran::where('jenis', 'sekunder')->count(),
            'tersier' => Saluran::where('jenis', 'tersier')->count(),
            'pintu' => Saluran::where('jenis', 'pintu')->count(),
            'bendungan' => Saluran::where('jenis', 'bendungan')->count(),
        ];

        $salurans = Saluran::orderBy('id', 'asc')->paginate(10);

        return view('masyarakat.home', compact('totalSaluran', 'saluranAktif', 'saluranBaik', 'saluranRusak', 'categories', 'salurans'));
    }
}

<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Saluran;
use Illuminate\Http\Request;

class DataIrigasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Saluran::query();

        if ($request->filled('kondisi') && $request->kondisi != 'all') {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->filled('jenis') && $request->jenis != 'all') {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('kecamatan', 'like', "%$search%");
            });
        }

        $salurans = $query->paginate(10)->withQueryString();

        $stats = [
            'total' => Saluran::count(),
            'baik' => Saluran::where('kondisi', 'baik')->count(),
            'perbaikan' => Saluran::where('kondisi', 'perbaikan')->count(),
            'rusak_berat' => Saluran::where('kondisi', 'rusak-berat')->count(),
            'rusak_sedang' => Saluran::where('kondisi', 'rusak-sedang')->count(),
            'rusak_ringan' => Saluran::where('kondisi', 'rusak-ringan')->count(),
        ];

        return view('masyarakat.data-irigasi', compact('salurans', 'stats'));
    }

    public function show($id)
    {
        $saluran = Saluran::findOrFail($id);
        return response()->json($saluran);
    }
}

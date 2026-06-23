<?php

namespace App\Http\Controllers\Admin;

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

        $salurans = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Saluran::count(),
            'baik' => Saluran::where('kondisi', 'baik')->count(),
            'perbaikan' => Saluran::where('kondisi', 'perbaikan')->count(),
            'rusak_berat' => Saluran::where('kondisi', 'rusak-berat')->count(),
            'rusak_sedang' => Saluran::where('kondisi', 'rusak-sedang')->count(),
            'rusak_ringan' => Saluran::where('kondisi', 'rusak-ringan')->count(),
        ];

        return view('admin.data-irigasi', compact('salurans', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:primer,sekunder,tersier,pintu,bendungan',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'required|in:baik,perbaikan,rusak-ringan,rusak-sedang,rusak-berat',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'level_air' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Saluran::create($validated);

        return redirect()->route('admin.data-irigasi.index')->with('success', 'Data saluran berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $saluran = Saluran::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:primer,sekunder,tersier,pintu,bendungan',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'required|in:baik,perbaikan,rusak-ringan,rusak-sedang,rusak-berat',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'level_air' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $saluran->update($validated);

        return redirect()->route('admin.data-irigasi.index')->with('success', 'Data saluran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $saluran = Saluran::findOrFail($id);
        $saluran->delete();

        return redirect()->route('admin.data-irigasi.index')->with('success', 'Data saluran berhasil dihapus!');
    }
}

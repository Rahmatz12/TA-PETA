<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('kode')) {
            $query->where('kode_laporan', 'like', '%' . $request->kode . '%');
        }

        if ($request->filled('telepon')) {
            $query->where('telepon', 'like', '%' . $request->telepon . '%');
        }

        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $laporans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total' => Laporan::count(),
            'menunggu' => Laporan::where('status', 'menunggu')->count(),
            'diverifikasi' => Laporan::where('status', 'diverifikasi')->count(),
            'diproses' => Laporan::where('status', 'diproses')->count(),
            'selesai' => Laporan::where('status', 'selesai')->count(),
            'ditolak' => Laporan::where('status', 'ditolak')->count(),
        ];

        return view('masyarakat.laporan', compact('laporans', 'stats'));
    }

    public function create()
    {
        return view('masyarakat.form-laporan');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_saluran' => 'required|string|max:255',
            'jenis_saluran' => 'required|in:primer,sekunder,tersier,pintu,bendungan',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'deskripsi_lokasi' => 'nullable|string',
            'jenis_kerusakan' => 'required|string',
            'tingkat_keparahan' => 'required|in:ringan,sedang,berat,kritis',
            'dampak_pertanian' => 'nullable|in:tidak-ada,ringan,sedang,berat,sangat-berat',
            'lama_kerusakan' => 'nullable|in:baru,1-7,7-30,lebih-1,tidak-tahu',
            'deskripsi_kerusakan' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_anonymous' => 'boolean',
        ];

        if (!$request->is_anonymous || !$request->user()) {
            $rules['nama_pelapor'] = 'required|string|max:255';
            $rules['telepon'] = 'required|string|max:20';
        }

        $validated = $request->validate($rules);

        $validated['kode_laporan'] = 'IRG-' . date('Y') . '-' . str_pad(Laporan::count() + 1, 5, '0', STR_PAD_LEFT);
        $validated['status'] = 'menunggu';

        if ($request->user()) {
            $validated['user_id'] = $request->user()->id;
        }

        if ($request->is_anonymous) {
            $validated['nama_pelapor'] = 'Anonim';
            $validated['telepon'] = '-';
            $validated['email'] = null;
        }

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        $laporan = Laporan::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim dengan kode: ' . $laporan->kode_laporan);
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return response()->json($laporan);
    }
}

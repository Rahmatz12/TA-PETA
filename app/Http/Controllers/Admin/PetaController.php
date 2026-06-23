<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Saluran;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $salurans = Saluran::all();
        $total = $salurans->count();
        $aktif = $salurans->where('status', 'aktif')->count();

        return view('admin.peta', compact('salurans', 'total', 'aktif'));
    }
}

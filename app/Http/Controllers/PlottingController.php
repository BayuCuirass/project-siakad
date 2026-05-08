<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Matakuliah;

class PlottingController extends Controller
{
    public function index()
    {
        $plotting = Dosen::with('matakuliah')->get();
        return view('plotting', compact('plotting'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        $matakuliah = Matakuliah::all();
        return view('plotting_create', compact('dosen', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $dosen = Dosen::findOrFail($request->dosen_id);
        $dosen->matakuliah()->syncWithoutDetaching([$request->matakuliah_id]);
        
        return redirect('/plotting')->with('success', 'Plotting berhasil ditambahkan');
    }

    public function destroy($dosen_id, $matakuliah_id)
    {
        $dosen = Dosen::findOrFail($dosen_id);
        $dosen->matakuliah()->detach($matakuliah_id);
        
        return redirect()->back()->with('success', 'Plotting dihapus');
    }
}
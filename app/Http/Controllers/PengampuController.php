<?php

namespace App\Http\Controllers;

use App\Models\Pengampu;
use App\Models\Dosen;
use App\Models\Matkul;
use Illuminate\Http\Request;

class PengampuController extends Controller
{
    public function index()
    {
        $pengampus = Pengampu::with(['dosen', 'matkul'])->get();
        $dosens = Dosen::dosen()->get();
        $matkuls = Matkul::all();

        return view('plotting', compact('pengampus', 'dosens', 'matkuls'));
    }

    public function simpan(Request $request)
    {
        Pengampu::create([
            'dosen_id' => $request->dosen_id,
            'matkul_id' => $request->matkul_id,
            'kelas' => $request->kelas,
        ]);

        return redirect('/plotting')->with('success', 'Data Plotting berhasil ditambahkan!');
    }

    public function hapus($id)
    {
        $pengampu = Pengampu::findOrFail($id);
        $pengampu->delete();

        return redirect('/plotting')->with('success', 'Data Plotting berhasil dihapus!');
    }
}
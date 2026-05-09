<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function index()
    {
        $matkul = Matkul::all();
        return view('matkul', compact('matkul'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required|unique:matkuls,kode_matkul',
            'nama_matkul' => 'required',
            'sks' => 'required|numeric'
        ]);

        Matkul::create($request->all());
        return redirect()->back()->with('success', 'Mata Kuliah berhasil ditambah!');
    }

    public function show($id)
    {
        return response()->json(Matkul::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $mk = Matkul::findOrFail($id);
        $mk->update($request->all());
        return response()->json(['success' => true]);
    }

    public function hapus($id)
    {
        Matkul::destroy($id);
        return redirect()->back()->with('success', 'Mata Kuliah berhasil dihapus');
    }
}
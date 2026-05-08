<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Pegawai;

class DosenController extends Controller
{
    public function index()
    {
        $data = Pegawai::where('jenis_pegawai', 'like', '%Dosen%')->get();
        return view('dosen', compact('data'));
    }
}
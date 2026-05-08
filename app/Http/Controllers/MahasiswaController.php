<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    // TAMPIL DATA
    public function tampil()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa', compact('mahasiswa'));
    }

    // SIMPAN DATA
    public function simpan(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:100',
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_prodi' => $request->prodi,
            'status_aktif' => $request->has('status_keaktifan') ? '1' : '0'
        ]);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    // AMBIL DATA EDIT
    public function show($id)
    {
        return response()->json(Mahasiswa::findOrFail($id));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_prodi' => $request->prodi,
            'status_aktif' => $request->status_keaktifan ? '1' : '0',
        ]);

        return response()->json(['success' => true]);
    }

    // HAPUS DATA
    public function hapus($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $data->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // EXPORT PDF
    public function pdf()
    {
        $data = Mahasiswa::all();
        $pdf = Pdf::loadView('pdf', ['data' => $data]);
        return $pdf->download('laporan_mahasiswa.pdf');
    }

    // EXPORT CSV (LANGSUNG DOWNLOAD)
    public function csv()
    {
        $fileName = 'laporan_mahasiswa.csv';
        $mahasiswa = Mahasiswa::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($mahasiswa) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['NIM', 'Nama', 'Program Studi', 'Status']);

            foreach ($mahasiswa as $mhs) {
                $prodi = '';
                if ($mhs->id_prodi == '1') $prodi = 'Sistem Informasi';
                elseif ($mhs->id_prodi == '2') $prodi = 'Teknik Informatika';
                elseif ($mhs->id_prodi == '3') $prodi = 'Teknik Komputer';
                else $prodi = $mhs->id_prodi;

                fputcsv($handle, [
                    $mhs->nim,
                    $mhs->nama,
                    $prodi,
                    $mhs->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif'
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // EXPORT EXCEL (SEDERHANA - LANGSUNG JADI)
    public function excel()
    {
        $fileName = 'laporan_mahasiswa.xls';
        $mahasiswa = Mahasiswa::all();

        $headers = [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($mahasiswa) {
            echo "NIM\tNama\tProgram Studi\tStatus\n";
            foreach ($mahasiswa as $mhs) {
                $prodi = '';
                if ($mhs->id_prodi == '1') $prodi = 'Sistem Informasi';
                elseif ($mhs->id_prodi == '2') $prodi = 'Teknik Informatika';
                elseif ($mhs->id_prodi == '3') $prodi = 'Teknik Komputer';
                else $prodi = $mhs->id_prodi;

                echo $mhs->nim . "\t" . $mhs->nama . "\t" . $prodi . "\t" . ($mhs->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif') . "\n";
            }
        };

        return response()->stream($callback, 200, $headers);
    }
}
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
        // WAJIB: Ambil data dosen buat dropdown di form tambah
        $dosens = Dosen::dosen()->get(); 
        
        return view('mahasiswa', compact('mahasiswa', 'dosens'));
    }

    // SIMPAN DATA
    public function simpan(Request $request)
{
    $status = $request->has('status_keaktifan') ? '1' : '0';

    Mahasiswa::create([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'prodi' => $request->prodi,    // <-- Pastikan tujuannya 'prodi'
        'status_aktif' => $status,
        'dosen_id' => $request->dosen_id,
    ]);

    return redirect('/mahasiswa')->with('success', 'Data Berhasil Ditambah!');
}

    // AMBIL DATA EDIT (AJAX)
    public function show($id)
    {
        return response()->json(Mahasiswa::findOrFail($id));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
{
    $mhs = Mahasiswa::findOrFail($id);
    $status = $request->status_keaktifan == '1' ? '1' : '0';

    $mhs->update([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'prodi' => $request->prodi,    // <-- Pastikan tujuannya 'prodi'
        'dosen_id' => $request->dosen_id,
        'status_aktif' => $status,
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

    // EXPORT CSV
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
            fputcsv($handle, ['NIM', 'Nama', 'Program Studi', 'Dosen Wali', 'Status']);

            foreach ($mahasiswa as $mhs) {
                $prodi = '';
                if ($mhs->prodi == '1') $prodi = 'Sistem Informasi';
                elseif ($mhs->prodi == '2') $prodi = 'Teknik Informatika';
                elseif ($mhs->prodi == '3') $prodi = 'Teknik Komputer';
                elseif ($mhs->prodi == '4') $prodi = 'TRPL';
                else $prodi = $mhs->prodi;

                fputcsv($handle, [
                    $mhs->nim,
                    $mhs->nama,
                    $prodi,
                    $mhs->dosen->nama ?? '-',
                    $mhs->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif'
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // EXPORT EXCEL SEDERHANA
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
            echo "NIM\tNama\tProgram Studi\tDosen Wali\tStatus\n";
            foreach ($mahasiswa as $mhs) {
                $prodi = '';
                if ($mhs->prodi == '1') $prodi = 'Sistem Informasi';
                elseif ($mhs->prodi == '2') $prodi = 'Teknik Informatika';
                elseif ($mhs->prodi == '3') $prodi = 'Teknik Komputer';
                elseif ($mhs->prodi == '4') $prodi = 'TRPL';
                else $prodi = $mhs->prodi;

                echo $mhs->nim . "\t" . 
                     $mhs->nama . "\t" . 
                     $prodi . "\t" . 
                     ($mhs->dosen->nama ?? '-') . "\t" . 
                     ($mhs->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif') . "\n";
            }
        };

        return response()->stream($callback, 200, $headers);
    }
}
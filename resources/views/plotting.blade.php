@extends('adminlte::page')

@section('title', 'Data Plotting Dosen')

@section('content_header')
    <h1>Plotting Dosen Pengampu</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus"></i> Tambah Plotting
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen Pengampu</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengampus as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    {{-- Mengambil nama matkul dan nama dosen dari relasi database --}}
                    <td>{{ $item->matkul->nama_matkul ?? 'Matkul Dihapus' }}</td>
                    <td>{{ $item->dosen->nama_dosen ?? 'Dosen Dihapus' }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>
                        <form action="/plotting/hapus/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus plotting ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color: white;">Tambah Plotting Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
            </div>
            <form action="/plotting/simpan" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <select name="matkul_id" class="form-control" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach($matkuls as $matkul)
                                <option value="{{ $matkul->id }}">{{ $matkul->nama_matkul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen Pengampu</label>
                        <select name="dosen_id" class="form-control" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="Contoh: SI-A" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Plotting</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
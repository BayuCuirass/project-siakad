@extends('adminlte::page')

@section('title', 'Data Mata Kuliah')

@section('content_header')
    <h1>Master Mata Kuliah</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Mata Kuliah</h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahMk">
                <i class="fas fa-plus"></i> Tambah Matkul
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="tableMk">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matkul as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->kode_matkul }}</td>
                    <td>{{ $item->nama_matkul }}</td>
                    <td>{{ $item->sks }} SKS</td>
                    <td>
                        <button class="btn btn-xs btn-warning btn-edit-mk" data-id="{{ $item->id }}">Edit</button>
                        <form action="/matkul/hapus/{{ $item->id }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-xs btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahMk">
    <div class="modal-dialog">
        <form action="/matkul/simpan" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Mata Kuliah</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Matkul</label>
                        <input type="text" name="kode_matkul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Matkul</label>
                        <input type="text" name="nama_matkul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>SKS</label>
                        <input type="number" name="sks" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#tableMk').DataTable();
</script>
@endsection
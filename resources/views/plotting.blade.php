@extends('adminlte::page')

@section('title', 'Plotting Dosen Pengampu')

@section('content_header')
    <h1>Plotting Dosen Pengampu Mata Kuliah</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengampu Mata Kuliah</h3>
        <div class="card-tools">
            <a href="/plotting/create" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Plotting
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tablePlotting">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plotting as $key => $dosen)
                    @foreach($dosen->matakuliah as $mk)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</td>
                        <td>
                            <form action="/plotting/{{ $dosen->id }}/{{ $mk->id }}" method="POST" onsubmit="return confirm('Hapus plotting ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tablePlotting').DataTable();
    });
</script>
@endsection
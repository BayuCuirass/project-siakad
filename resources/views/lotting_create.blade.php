@extends('adminlte::page')

@section('title', 'Tambah Plotting')

@section('content_header')
    <h1>Tambah Plotting Dosen Pengampu</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Plotting</h3>
    </div>
    <div class="card-body">
        <form action="/plotting" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Dosen</label>
                <select name="dosen_id" class="form-control" required>
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Pilih Mata Kuliah</label>
                <select name="matakuliah_id" class="form-control" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/plotting" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
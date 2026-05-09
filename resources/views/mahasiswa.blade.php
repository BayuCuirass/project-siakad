@extends('adminlte::page')

@section('title', 'Data Mahasiswa')

@section('content_header')
    <h1>Manajemen Mahasiswa (SIAKAD)</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Mahasiswa</h3>
        <div class="card-tools">
            <a href="/mahasiswa/pdf" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
            <a href="/mahasiswa/excel" class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="/mahasiswa/csv" class="btn btn-info btn-sm">
                <i class="fas fa-file-csv"></i> CSV
            </a>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
            <button class="btn btn-default btn-sm" onclick="location.reload()">
                <i class="fas fa-sync"></i> Refresh
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3">{{ session('success') }}</div>
    @endif

    <div class="card-body">
        <table class="table table-bordered table-striped" id="tableMahasiswa">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Dosen Wali</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        @if($item->prodi == '1') Sistem Informasi
                        @elseif($item->prodi == '2') Teknik Informatika
                        @elseif($item->prodi == '3') Teknik Komputer
                        @elseif($item->prodi == '4') TRPL
                        @else {{ $item->prodi }}
                        @endif
                    </td>
                    {{-- Tampilkan Nama Dosen Wali --}}
                    <td>{{ $item->dosen->nama_dosen ?? 'Belum Ada Dosen' }}</td>
                    <td>
                        <span class="badge {{ $item->status_aktif == '1' ? 'badge-success' : 'badge-danger' }}">
                            {{ $item->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-warning btn-edit" data-id="{{ $item->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="/mahasiswa/hapus/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger">
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

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form action="/mahasiswa/simpan" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select name="prodi" class="form-control" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="1">Sistem Informasi</option>
                            <option value="2">Teknik Informatika</option>
                            <option value="3">Teknik Komputer</option>
                            <option value="4">TRPL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen Wali</label>
                        <select name="dosen_id" class="form-control">
                            <option value="">-- Pilih Dosen Wali --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Mahasiswa</label>
                        <div class="custom-control custom-switch">
                            <input type="hidden" name="status_keaktifan" value="0">
                            <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status_keaktifan" value="1" checked>
                            <label class="custom-control-label" for="statusSwitch">Aktif</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <form id="formEdit">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" id="edit_nim" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select id="edit_prodi" class="form-control" required>
                            <option value="1">Sistem Informasi</option>
                            <option value="2">Teknik Informatika</option>
                            <option value="3">Teknik Komputer</option>
                            <option value="4">TRPL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen Wali</label>
                        <select id="edit_dosen_id" class="form-control">
                            <option value="">-- Pilih Dosen Wali --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="edit_status">
                            <label class="custom-control-label" for="edit_status">Aktif</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('#tableMahasiswa').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        }
    });

    $('.btn-edit').on('click', function() {
        let id = $(this).data('id');
        $.get('/mahasiswa/' + id, function(data) {
            $('#edit_id').val(data.id);
            $('#edit_nim').val(data.nim);
            $('#edit_nama').val(data.nama);
            $('#edit_prodi').val(data.prodi);
            $('#edit_dosen_id').val(data.dosen_id); // Mengisi nilai Dosen Wali
            $('#edit_status').prop('checked', data.status_aktif == '1');
            $('#modalEdit').modal('show');
        });
    });

    $('#formEdit').on('submit', function(e) {
        e.preventDefault();
        let id = $('#edit_id').val();
        $.ajax({
            url: '/mahasiswa/' + id,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                nim: $('#edit_nim').val(),
                nama: $('#edit_nama').val(),
                prodi: $('#edit_prodi').val(),
                dosen_id: $('#edit_dosen_id').val(), // Mengirim update Dosen Wali
                status_keaktifan: $('#edit_status').is(':checked') ? 1 : 0
            },
            success: function() {
                $('#modalEdit').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});
</script>
@endsection
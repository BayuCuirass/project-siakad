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

<div class="modal fade" id="modalEditMk">
    <div class="modal-dialog">
        <form id="formEditMk">
            @csrf
            <input type="hidden" id="edit_mk_id">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Mata Kuliah</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Matkul</label>
                        <input type="text" id="edit_kode_matkul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Matkul</label>
                        <input type="text" id="edit_nama_matkul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>SKS</label>
                        <input type="number" id="edit_sks" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        $('#tableMk').DataTable();

        function showEditModal(id) {
            $.get('/matkul/' + id, function(data) {
                $('#edit_mk_id').val(data.id);
                $('#edit_kode_matkul').val(data.kode_matkul);
                $('#edit_nama_matkul').val(data.nama_matkul);
                $('#edit_sks').val(data.sks);
                $('#modalEditMk').modal('show');
            }).fail(function() {
                alert('Gagal mengambil data mata kuliah.');
            });
        }

        $('.btn-edit-mk').on('click', function() {
            const id = $(this).data('id');
            showEditModal(id);
        });

        $('#formEditMk').on('submit', function(e) {
            e.preventDefault();
            const id = $('#edit_mk_id').val();
            const token = $('input[name="_token"]', this).val();

            $.ajax({
                url: '/matkul/' + id,
                type: 'PUT',
                data: {
                    _token: token,
                    kode_matkul: $('#edit_kode_matkul').val(),
                    nama_matkul: $('#edit_nama_matkul').val(),
                    sks: $('#edit_sks').val()
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Gagal memperbarui data mata kuliah.');
                    }
                },
                error: function(xhr) {
                    let message = 'Terjadi kesalahan saat memperbarui data.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = Object.values(xhr.responseJSON.errors).join('\n');
                    }
                    alert(message);
                }
            });
        });
    });
</script>
@endsection
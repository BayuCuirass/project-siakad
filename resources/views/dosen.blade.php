@extends('adminlte::page')

@section('title', 'Data Dosen')

@section('content_header')
    <h1>Manajemen Dosen (SIAKAD)</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Dosen</h3>
        <div class="card-tools">
            <button class="btn btn-primary btn-sm" onclick="location.reload()">
                <i class="fas fa-sync"></i> Refresh
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="tableDosen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>Jenis Pegawai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_pegawai }}</td>
                    <td>
                        @php
                            $status = $item->status_kepegawaian ?? $item->status;
                            $badgeClass = in_array($status, ['Aktif', 'Tetap', 'PNS'], true) ? 'success' : 'warning';
                        @endphp
                        <span class="badge badge-{{ $badgeClass }}">{{ $status ?? 'Tidak Diketahui' }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data dosen</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tableDosen').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });
    });
</script>
@endsection
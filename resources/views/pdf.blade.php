<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Mahasiswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Data Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nim }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    @if($item->id_prodi == '1') Sistem Informasi
                    @elseif($item->id_prodi == '2') Teknik Informatika
                    @elseif($item->id_prodi == '3') Teknik Komputer
                    @else Teknik Rekayasa Perangkat Lunak
                    @endif
                </td>
                <td>{{ $item->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
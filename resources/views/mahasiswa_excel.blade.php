<table border="1">
    <thead>
        <tr>
            <th colspan="5" style="font-size: 14pt; font-weight: bold; text-align: center; background-color: #f2f2f2;">
                LAPORAN DATA MAHASISWA SIAKAD
            </th>
        </tr>
        <tr style="background-color: #007bff; color: #ffffff; font-weight: bold; text-align: center;">
            <th width="5">No</th>
            <th width="15">NIM</th>
            <th width="30">Nama Mahasiswa</th>
            <th width="20">Program Studi</th>
            <th width="20">Dosen Wali</th>
            <th width="15">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $key => $item)
        <tr>
            <td style="text-align: center;">{{ $key + 1 }}</td>
            <td style="text-align: center;">'{{ $item->nim }}</td> {{-- Tanda petik tunggal biar NIM tidak dianggap angka ribuan --}}
            <td>{{ $item->nama }}</td>
            <td>
                @if($item->prodi == '1') Sistem Informasi
                @elseif($item->prodi == '2') Teknik Informatika
                @elseif($item->prodi == '3') Teknik Komputer
                @elseif($item->prodi == '4') TRPL
                @else {{ $item->prodi }}
                @endif
            </td>
            <td>{{ $item->dosen->nama_dosen ?? '-' }}</td>
            <td style="text-align: center; color: {{ $item->status_aktif == '1' ? '#28a745' : '#dc3545' }};">
                {{ $item->status_aktif == '1' ? 'Aktif' : 'Tidak Aktif' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
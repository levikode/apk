<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Pegawai</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Pegawai</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Unit Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $dt)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dt->nama }}</td>
                <td>{{ $dt->nip }}</td>
                <td>{{ $dt->jabatan->nama }}</td>
                <td>{{ $dt->jeniskelamin }}</td>
                <td>{{ $dt->unitkerja->nama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

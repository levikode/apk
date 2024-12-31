<!DOCTYPE html>
<html>

<head>
    <title>Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Data Pegawai</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Usia</th>
                <th>Masa Kerja</th>
                <th>Status Keluarga</th>
                <th>Golongan Darah</th>
                <th>Agama</th>
                <th>Unit Kerja</th>
                <th>Alamat</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPegawai as $index => $pegawai)
            <tr>
                <td>{{ $loop->iteration }}</td>
               
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->jabatan->nama}}</td>
                <td>{{ $pegawai->jeniskelamin }}</td>
                <td>{{ $pegawai->tempatlahir }}</td>
                <td>{{ $pegawai->tanggallahir }}</td>
                <td>{{ $pegawai->usia }}</td>
                <td>{{ $pegawai->masakerja }}</td>
                <td>{{ $pegawai->keluarga->nama}}</td>
                <td>{{ $pegawai->golongan->nama }}</td>
                <td>{{ $pegawai->agama->nama}}</td>
                <td>{{ $pegawai->unitkerja->nama }}</td>
                <td>{{ $pegawai->alamat }}</td>
                <td>{{ $pegawai->user->name}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
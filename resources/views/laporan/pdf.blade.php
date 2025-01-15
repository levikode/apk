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

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        img {
        max-width: 100px; /* Atur ukuran gambar */
        height: auto;
    }
    </style>
</head>

<body>
    <h1>Data Pegawai</h1>
    @if(isset($start_date) && isset($end_date))
    <p>Periode: {{ request('start_date') }} - {{ request('end_date') }}</p>
        <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Ttl</th>
                <th>Usia</th>
                <th>tmt</th>
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
            @foreach ($pegawai as $index => $pegawai)
            <tr>
                <td>{{ $loop->iteration }}</td>
                
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->jabatan->nama}}</td>
                <td>{{ $pegawai->jeniskelamin }}</td>
                <td>{{ $pegawai->ttl }}</td>
                <td>{{ $pegawai->usia }}</td>
                <td>{{ $pegawai->tmt }}</td>
                <td>{{ $pegawai->masakerja }}</td>
                <td>{{ $pegawai->statuskeluarga}}</td>
                <td>{{ $pegawai->golongandarah}}</td>
                <td>{{ $pegawai->agama}}</td>
                <td>{{ $pegawai->unitkerja->nama }}</td>
                <td>{{ $pegawai->alamat }}</td>
                <td>{{ $pegawai->user->name}}</td>

            </tr>
            
            @endforeach
        </tbody>
    </table>
    @else 
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Ttl</th>
                <th>Usia</th>
                <th>tmt</th>
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
            @foreach ($pegawai as $index => $pegawai)
            <tr>
                <td>{{ $loop->iteration }}</td>
                
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->jabatan->nama}}</td>
                <td>{{ $pegawai->jeniskelamin }}</td>
                <td>{{ $pegawai->ttl }}</td>
                <td>{{ $pegawai->usia }}</td>
                <td>{{ $pegawai->tmt }}</td>
                <td>{{ $pegawai->masakerja }}</td>
                <td>{{ $pegawai->statuskeluarga}}</td>
                <td>{{ $pegawai->golongandarah}}</td>
                <td>{{ $pegawai->agama}}</td>
                <td>{{ $pegawai->unitkerja->nama }}</td>
                <td>{{ $pegawai->alamat }}</td>
                <td>{{ $pegawai->user->name}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    
</body>

</html>
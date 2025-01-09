@extends('layouts.template')
@section('judulh1','Tampil Pegawai')
@section('konten')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h3 class="card-title text-primary">Detail Pegawai</h3>
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Foto -->
                <div class="col-md-4 text-center">
                    @if ($data[0]->foto)
                        <img src="{{ asset('storage/' . $data[0]->foto) }}" alt="Foto {{ $data[0]->nama }}" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                    @else
                        <p class="text-muted">Tidak ada foto</p>
                    @endif
                </div>
                <!-- Data Pegawai -->
                <div class="col-md-8">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Nama Pegawai</th>
                                <td>{{ $data[0]->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>{{ $data[0]->nip }}</td>
                            </tr>
                            <tr>
                                <th>jabatan</th>
                                <td>{{ $data[0]->jabatan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $data[0]->jeniskelamin }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $data[0]->tempatlahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $data[0]->tanggallahir }}</td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <td>{{ $data[0]->usia }}</td>
                            </tr>
                            <tr>
                                <th>Masa Kerja</th>
                                <td>{{ $data[0]->masakerja }}</td>
                            </tr>
                            <tr>
                                <th>User</th>
                                <td>{{ $data[0]->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Keluarga</th>
                                <td>{{ $data[0]->keluarga->nama }}</td>
                            </tr>
                            <tr>
                                <th>Golongan</th>
                                <td>{{ $data[0]->golongan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $data[0]->agama->nama }}</td>
                            </tr>
                            <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $data[0]->unitkerja->nama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $data[0]->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

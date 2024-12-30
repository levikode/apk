@extends('layouts.template')

@section('judulh1','Admin - Ubah Pegawai')

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

    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Ubah Data Pegawai</h3>
        </div>
        <!-- Form Start -->
        <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Pegawai</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pegawai->nama) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" class="form-control" id="nip" name="nip" value="{{ old('nip', $pegawai->nip) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jeniskelamin" name="jeniskelamin" required>
                                <option value="Laki-laki" {{ old('jeniskelamin', $pegawai->jeniskelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jeniskelamin', $pegawai->jeniskelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempatlahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="{{ old('tempatlahir', $pegawai->tempatlahir) }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggallahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" value="{{ old('tanggallahir', $pegawai->tanggallahir) }}">
                        </div>
                        <div class="form-group">
                            <label for="usia">Usia</label>
                            <input type="number" class="form-control" id="usia" name="usia" value="{{ old('usia', $pegawai->usia) }}">
                        </div>
                        <div class="form-group">
                            <label for="masakerja">Masa Kerja</label>
                            <input type="number" class="form-control" id="masakerja" name="masakerja" value="{{ old('masakerja', $pegawai->masakerja) }}">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User</label>
                            <select class="form-control" name="user_id">
                                @foreach($user as $dt)
                                <option value="{{ $dt->id }}" {{ $pegawai->user_id == $dt->id ? 'selected' : '' }}>{{ $dt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keluarga</label>
                            <select class="form-control" name="keluarga_id">
                                @foreach($keluarga as $dt)
                                <option value="{{ $dt->id }}" {{ $pegawai->keluarga_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Golongan</label>
                            <select class="form-control" name="golongan_id">
                                @foreach($golongan as $dt)
                                <option value="{{ $dt->id }}" {{ $pegawai->golongan_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select class="form-control" name="agama_id">
                                @foreach($agama as $dt)
                                <option value="{{ $dt->id }}" {{ $pegawai->agama_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit Kerja</label>
                            <select class="form-control" name="unitkerja_id">
                                @foreach($unitkerja as $dt)
                                <option value="{{ $dt->id }}" {{ $pegawai->unitkerja_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control" name="jabatan_id">
                                @foreach($jabatan as $dt)
                                <option value="{{ $dt->id }}" {{ $pegawai->jabatan_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $pegawai->alamat) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i> Ubah</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

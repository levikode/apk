@extends('layouts.template')
@section('judulh1','Admin - pegawai')
@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Ubah Data pegawai</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('pegawai.update',$pegawai->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class=" card-body">
            <div class=" card-body">
                <div class="form-group">
                    <label for="nama">Nama Pegawai</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="{{$pegawai->nama}}">
                </div>
                <div class="form-group">
                    <label for="nip">nip</label>
                    <input type="number" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}">
                    <div class="form-group">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jeniskelamin" name="jeniskelamin">
                                <option value="Laki-laki" {{ old('jeniskelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    <div class="form-group">
                    <label for="tempatlahir">tempat lahir</label>
                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="{{$pegawai->tempatlahir}}">
                    <div class="form-group">
                    <label for="tanggallahir">tanggal lahir</label>
                    <input type="text" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="" value="{{$pegawai->tanggallahir}}">
                </div> 
                <div class="form-group">
                    <label for="usia">usia</label>
                    <input type="number" class="form-control" id="usia" name="usia" value="{{$pegawai->usia}}">
                </div> 
                <div class="form-group">
                    <label for="masakerja">masa kerja</label>
                    <input type="number" class="form-control" id="masakerja" name="masakerja" value="{{$pegawai->masakerja}}">
                </div> 
                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user_id">
                        @foreach($user as $dt )
                        <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>keluarga</label>
                    <select class="form-control" name="keluarga_id">
                        @foreach($keluarga as $dt )
                        <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Golongan</label>
                    <select class="form-control" name="golongan_id">
                        @foreach($golongan as $dt )
                        <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="form-group">
                    <label>Agama</label>
                    <select class="form-control" name="agama_id">
                        @foreach($agama as $dt )
                        <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>unitkerja</label>
                    <select class="form-control" name="unitkerja_id">
                        @foreach($unitkerja as $dt )
                        <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>
              
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="" value="{{$pegawai->alamat}}">
                </div> 
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
       
                <button type="submit" class="btn btn-warning floatright">Ubah</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.template')
@section('judulh1','Tambah Pegawai')

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
        <div class="card-header bg-success text-white">
            <h3 class="card-title">Tambah Data Pegawai</h3>
        </div>
        <!-- Form Start -->
        <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Pegawai</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" maxlength="16" required>
                        </div>
                        <div class="form-group">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jeniskelamin" name="jeniskelamin" required>
                                <option value="Laki-laki" {{ old('jeniskelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jeniskelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempat_lahir') }}">
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            <small id="tanggalLahirError" class="text-danger" style="display: none;">
                                Pegawai harus berusia minimal 17 tahun!
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="usia">Usia</label>
                            <input type="number" class="form-control" id="usia" name="usia" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tmt">tmt</label>
                            <input type="date" class="form-control" id="tmt" name="tmt" value="{{ old('tmt') }}">
                            
                        </div>
                        <div class="form-group">
                            <label for="masakerja">Masa Kerja</label>
                            <input type="number" class="form-control" id="masakerja" name="masakerja" placeholder="Masukkan Masa Kerja">
                        </div>

                    </div>
                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Admin</label>
                            <select class="form-control" name="user_id">
                                @foreach($user as $dt)
                                <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="statuskeluarga">statuskeluarga</label>
                            <select class="form-control" id="statuskeluarga" name="statuskeluarga">
                                <option value="" disabled selected>Pilih status keluarga</option>
                                <option value="menikah" {{ old('statuskeluarga') == 'menikah' ? 'selected' : '' }}>menikah</option>
                                <option value="belum menikah" {{ old('statuskeluarga') == 'belum menikah' ? 'selected' : '' }}>belum menikah</option>
                                <option value="cerai" {{ old('statuskeluarga') == 'cerai' ? 'selected' : '' }}>cerai</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="golongandarah">golongandarah</label>
                            <select class="form-control" id="golongandarah" name="golongandarah">
                                <option value="" disabled selected>Pilih Golongan darah</option>
                                <option value="-O" {{ old('golongandarah') == '-O' ? 'selected' : '' }}>-O</option>
                                <option value="+O" {{ old('golongandarah') == '+O' ? 'selected' : '' }}>+O</option>
                                <option value="-A" {{ old('golongandarah') == '-A' ? 'selected' : '' }}>-A</option>
                                <option value="+A" {{ old('golongandarah') == '+A' ? 'selected' : '' }}>+A</option>
                                <option value="-B" {{ old('golongandarah') == '-B' ? 'selected' : '' }}>-B</option>
                                <option value="+B" {{ old('golongandarah') == '+B' ? 'selected' : '' }}>+B</option>
                                <option value="-AB" {{ old('golongandarah') == '-AB' ? 'selected' : '' }}>-AB</option>
                                <option value="+AB" {{ old('golongandarah') == '+AB' ? 'selected' : '' }}>+AB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control" id="agama" name="agama">
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                <option value="Kristen Katolik" {{ old('agama') == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit Kerja</label>
                            <select class="form-control" name="unitkerja_id">
                                @foreach($unitkerja as $dt)
                                <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control" name="jabatan_id">
                                @foreach($jabatan as $dt )
                                <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
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
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    document.getElementById('nip').addEventListener('input', function(e) {
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16); // Potong input ke 16 karakter
        }
    });

    // Script untuk menghitung usia otomatis berdasarkan tanggal lahir yang dipilih
    document.getElementById('tanggal_lahir').addEventListener('change', function() {
        var tanggalLahir = new Date(this.value);
        var usia = new Date().getFullYear() - tanggalLahir.getFullYear();
        var m = new Date().getMonth() - tanggalLahir.getMonth();
        if (m < 0 || (m === 0 && new Date().getDate() < tanggalLahir.getDate())) {
            usia--;
        }
        // Menampilkan usia di field usia
        document.getElementById('usia').value = usia;
    });
    document.getElementById('tmt').addEventListener('change', function() {
        var tmt = new Date(this.value);
        var masakerja = new Date().getFullYear() - tmt.getFullYear();
        var m = new Date().getMonth() - tmt.getMonth();
        if (m < 0 || (m === 0 && new Date().getDate() < tmt.getDate())) {
            masakerja--;
        }
        // Menampilkan masakerja di field masakerja
        document.getElementById('masakerja').value = masakerja;
    });

    const tanggalLahirInput = document.getElementById('tanggal_lahir');
    const tanggalLahirError = document.getElementById('tanggalLahirError');
    const submitButton = document.getElementById('submitButton');

    tanggalLahirInput.addEventListener('input', function() {
        const tanggalLahir = new Date(this.value);
        const today = new Date();
        const umur = today.getFullYear() - tanggalLahir.getFullYear();
        const bulan = today.getMonth() - tanggalLahir.getMonth();
        const hari = today.getDate() - tanggalLahir.getDate();

        // Validasi usia minimal 17 tahun
        if (umur < 17 || (umur === 17 && (bulan < 0 || (bulan === 0 && hari < 0)))) {
            tanggalLahirError.style.display = 'block';
            submitButton.disabled = true;
        } else {
            tanggalLahirError.style.display = 'none';
            submitButton.disabled = false;
        }
    });
</script>
@endsection
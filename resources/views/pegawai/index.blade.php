@extends('layouts.template')

@section('title', 'Data Pegawai')

@section('tambahanCSS')
<!-- DataTables -->

<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('judulh1', 'Pegawai')

@section('konten')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="row">
        <div class="col-lg-11 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <a href="{{ route('pegawai.pdf') }}" class="btn btn-primary">Download PDF</a>
                    <h4 class="m-0 font-weight-bold text-secondary">Data Pegawai</h4>


                    <a href="{{ route('pegawai.create') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Pegawai</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <form action="{{ route('pegawai.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Cari NIP pegawai" value="{{ request('search') }}">
                            <button class="btn btn-primary mb-3 btn-sm mt-3" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $dt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($dt->foto)
                                        <img src="{{ asset('storage/' . $dt->foto) }}" alt="Foto {{ $dt->nama }}" width="100">
                                        @else
                                        Tidak ada foto
                                        @endif
                                    </td>
                                    <td>{{ $dt->nama }}</td>
                                    <td>{{ $dt->nip }}</td>
                                    <td>{{ $dt->jabatan->nama}}</td>
                                    <td>{{ $dt->jeniskelamin }}</td>
                                    <td>{{ $dt->tempatlahir }}</td>
                                    <td>{{ $dt->tanggallahir }}</td>
                                    <td>{{ $dt->usia }}</td>
                                    <td>{{ $dt->masakerja }}</td>
                                    <td>{{ $dt->keluarga->nama}}</td>
                                    <td>{{ $dt->golongan->nama }}</td>
                                    <td>{{ $dt->agama->nama}}</td>
                                    <td>{{ $dt->unitkerja->nama }}</td>
                                    <td>{{ $dt->alamat }}</td>
                                    <td>{{ $dt->user->name}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('pegawai.destroy', $dt->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('pegawai.edit', $dt->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('pegawai.show', $dt->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
    <!-- Tombol Previous -->
    @if ($pegawai->onFirstPage())
        <span class="btn btn-secondary disabled">Previous</span>
    @else
        <a href="{{ $pegawai->previousPageUrl() }}" class="btn btn-primary">Previous</a>
    @endif

    <!-- Tombol Next -->
    @if ($pegawai->hasMorePages())
        <a href="{{ $pegawai->nextPageUrl() }}" class="btn btn-primary">Next</a>
    @else
        <span class="btn btn-secondary disabled">Next</span>
    @endif
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        @endsection

        @section('tambahanJS')
        <!-- DataTables & Plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        @endsection

        @section('tambahScript')
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables
                $('#example1').DataTable({
                    "pagingType": simple,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": true,
                    "pageLength": 5,
                    "lengthMenu": [5, 10, 25, 50],
                    "searching": true,
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak ada data tersedia",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Berikutnya",
                            "previous": "Sebelumnya"
                        }
                    },
                
                    "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                        '<"row"<"col-sm-12"tr>>' +
                        '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                });

                
            });
        </script>
        
        @endsection
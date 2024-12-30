
@section('tambahanJS')
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection

@section('tambahScript')
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "responsive": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

@if($message = Session::get('success'))
toastr.success("{{ $message}}");
@elseif($message = Session::get('updated'))
toastr.warning("{{ $message}}");
@elseif($message = Session::get('deleted'))
toastr.error("{{ $message}}");
@endif
</script>
@endsection


@extends('layouts.template')

@section('title', 'Data pegawai')

@section('tambahanCSS')
<!-- DataTables -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('judulh1', 'pegawai')

@section('konten')

<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">Data pegawai</h4>
            <a href="{{ route('pegawai.cetakPDF') }}" class="btn btn-primary btn-icon-split">
    <span class="icon text-white-50">
        <i class="fas fa-file-pdf"></i>
    </span>
    <span class="text">Cetak PDF</span>
</a>
            <a href="{{ route('pegawai.create') }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah pegawai</span>
            </a>
           

        </div>
        <div class="card-body">
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
            </div>
        </div>
    </div>
</div>

@endsection

@section('tambahanJS')
<!-- DataTables  & Plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection

@section('tambahScript')
<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthChange": true
        });
    });

    @if($message = Session::get('success'))
        toastr.success("{{ $message }}");
    @elseif($message = Session::get('updated'))
        toastr.warning("{{ $message }}");
    @elseif($message = Session::get('deleted'))
        toastr.error("{{ $message }}");
    @endif
</script>
@endsection

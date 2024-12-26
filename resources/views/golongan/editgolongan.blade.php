@extends('layouts.template')
@section('judulh1','Admin - Golongan')

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
            <h3 class="card-title">Ubah Data Golongan Darah</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('golongan.update',$golongan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class=" card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="{{$golongan->nama}}">
                </div>                  
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>

</div>

@endsection






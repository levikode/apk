@extends('layouts.template')
@section('judulh1','Admin - Unitkerja')

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
            <h3 class="card-title">Ubah Data Unit Kerja</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('user.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card-body">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="" value="{{$user->name}}">
                </div>                  
            </div>
            <div class=" card-body">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{$user->email}}">
                </div>                  
            </div>
            <div class="card-body">
    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group my-input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" value="{{$user->password}}">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa fa-eye" id="togglePassword"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<style>
    .my-input-group .input-group-text {
        border-left: none;
        background-color: #f8f9fa;
    }

    .fa-eye {
        cursor: pointer;
    }
</style>

<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        var passwordField = document.getElementById("password");
        var icon = this;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    });
</script>


            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>

</div>

@endsection







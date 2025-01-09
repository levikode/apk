<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login User</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page" style="background-image: url('4.jpg');background-size: cover;">
    <div class="login-box">
        <div class="card card-outline card-primary" style="background: transparent; border: 2px solid rgba(225, 225, 225, .2); backdrop-filter: blur(5px); color: #fff; border-radius: 20px; padding: 20px 30px;">
            <div class="card-header text-center">
                <h1 class="h1"><b style="color:rgb(18, 34, 51);">Aplikasi <b style="color:rgb(43, 63, 85);">PENDATAAN</b></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg" style="color:rgb(14, 28, 43) ;">Please Login</p>
                @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    {{ session('loginError') }}
                </div>
                @endif
                <form action="/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye" id="togglePassword"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="reset" class="btn btn-warning">Cancel</button>
                        <button type="submit" class="btn btn-primary float-right">Login</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            if (password.type === 'password') {
                password.type = 'text';
                togglePassword.classList.remove('fas-eye');
                togglePassword.classList.add('fas-eye-slash');
            } else {
                password.type = 'password';
                togglePassword.classList.remove('fas-eye-slash');
                togglePassword.classList.add('fas-eye');
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/css/ruang-admin.min.css') }}" rel="stylesheet" />
    </head>

    <body class="bg-gradient-login">
        <div class="container-login">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-12 col-md-9">
                    <div class="card shadow-sm my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="login-form">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Learning Managment System</h1>
                                        </div>
                                        <!-- <p class="login-box-msg">Sign in to start your session</p> -->
                                        @if(session('error'))
                                        <div class="alert alert-danger">{{session('error')}}</div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}" class="user">
                                            @csrf
                                            <div class="form-group">
                                                <input id="name" type="text" placeholder="User Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" />
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="remember" />
                                                <label for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                            <!-- /.col -->
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                            </div>
                                        </form>
                                        <hr />
                                        <div class="text-center">
                                            <a class="font-weight-bold small" href="{{url('forget/password')}}">I forgot my password</a>
                                        </div>
                                        <div class="text-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/ruang-admin.min.js') }}"></script>
    </body>
</html>

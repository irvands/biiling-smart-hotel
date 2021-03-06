<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart Hotel - LOGIN</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/puse-icons-feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('/images/iconn.jpg')}}" />
</head>

<body>
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                <div class="content-wrapper d-flex align-items-center auth theme-one">

                    <div class="row w-100">
                        <div class="col-md-12" style="margin-bottom: 20px;">

                        </div>
                        <div class="col-lg-4 mx-auto">
                            <div class="auto-form-wrapper">
                                <div class="text-center">
                                    <img src="{{asset('/images/logosh2.png')}}">
                                </div>
                                <p>
                                    <div class="form-group has-feedback">
                                        <label class="label">Email</label>
                                        <div class="input-group">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                required autofocus>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="mdi mdi-check-circle-outline"></i>
                                                </span>
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label class="label">Password</label>
                                        <div class="input-group">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="mdi mdi-check-circle-outline"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="link float-right">
                                            <small>Forget Password ?</small></a>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary submit-btn btn-block"
                                            type="submit">Login</button>
                                    </div>

                                    <div class="form-group has-feedback text-center">
                                        <small>Don't Have an Account ? <a href="{{ route('register') }}">
                                                Register</a>
                                            <p>OR</p>
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{route('login.google')}}"  class="btn btn-danger submit-btn btn-block btn-fw" type="submit">
                                        <i class="mdi mdi-google-plus"></i>Login With Google</a>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{route('login.facebook')}}" class="btn btn-primary submit-btn btn-block" type="submit"><i class="mdi mdi-facebook"></i>Login With
                                            Facebook</a>
                                    </div>
                            </div>
                            <p class="footer-text text-center" style="margin-top: 20px;color: #308ee0">Copyright ??
                                {{date('Y')}} Smart Hotel - All rights reserved.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </form>
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
</body>

</html>

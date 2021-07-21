<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Hotel</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.nice-number.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/select2.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/ijaboCropTool.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/cropper.css')}}">
    <!-- <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" /> -->

    <style>
        .card {
            box-shadow: 0 0 10px 0 rgba(100, 100, 100, 0.26);
        }

        .inner {
            overflow: hidden;
        }

        .inner img {
            transition: all 1.5s ease;
        }

        .inner:hover img {
            transform: scale(1.5);
        }

        .img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid blue;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

    </style>
    @section('css')

    @show
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('/images/iconn.jpg')}}" />
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">


                <img src="{{asset('images/logos2.png')}}" class="navbar-brand brand-logo">
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                    <i class="fa fa-align-justify" style="color: #fff;"></i>
                </button>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item dropdown d-xl-inline-block">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="profile-text">Halo, {{Auth::user()->name}} !</span>
                            <?php
                            $ava_s = Auth::user()->avatar;
                            if(preg_match('@^https?://@', $ava_s )){
                                $avatars = $ava_s ;
                            }else{
                                $avatars = asset('images/user/'.$ava_s );
                            }
                            ?>
                            @if(!empty(Auth::user()->avatar))
                            <img src="{{$avatars}}" class="img-xs rounded-circle" alt="profile image">
                            @else
                            <img src="{{asset('images/user/ava.png')}}" class="img-xs rounded-circle"
                                alt="profile image">
                            @endif


                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <a class="dropdown-item p-0">
                                <div class="d-flex border-bottom">

                                </div>
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Sign Out

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @section('sidebar')
                @include('layouts.sidebar')
                @show
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')

                </div>
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            {{date('Y')}}
                            <a href="#" target="_blank">Smart Hotel</a>. All rights
                            reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-number.js')}}"></script>
    <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    <script type="text/javascript"
	      src="https://app.sandbox.midtrans.com/snap/snap.js"
	      data-client-key="SB-Mid-client-2rHrh2aAq0fayN3Z"></script>
    @include('sweetalert::alert')
    @section('js')

    @show

    <script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>
    <script src="{{asset('js/kamar.js')}}"></script>
    <script src="{{asset('js/ijaboCropTool.min.js')}}"></script>

    <script>
        $(function () {

            $('input[type="number"]').niceNumber();

        });

    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            var $modal = $('#modal_crop');
            var avatar_img = document.getElementById('sample_image');
            var cropper;

            $(document).on('click', '#change_avatar', function (event) {
                $('#avatar_img').click();
            });
            $('#avatar_img').change(function (event) {
                var files = event.target.files;
                var done = function (url) {
                    avatar_img.src = url;
                    $modal.modal('show');
                };

                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function (event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });
            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(avatar_img, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function () {

                canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400
                });
                canvas.toBlob(function (blob) {
                    url = URL.createObjectURL(blob);
                    reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64data = reader.result;
                        var imagebase64 = $('#base64image').val(base64data)
                    };
                });

    
            });


        });

    </script>
    <script>
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('#password').attr('type','text');
			}else{
				$('#password').attr('type','password');
			}
		});
	});
    </script>

<script>
        $('#btn-submit').one('click', function (event) {
            event.preventDefault();
            swal({
                title: 'Apakah Yakin Untuk Menyelesaikan Transaksi?',
                text: 'Anda tidak bisa membuat transaksi barul sebelum melakukan pembayaran !',
                icon: 'warning',
                button: ["Batal", "Yakin!"],
            }).then(function (value) {
                if (value) {
                    document.getElementById('selesaikan').submit();
                    document.getElementById('btn-submit').disabled = true;
                    document.getElementById('bayar').disabled = false;
                }
            });
        });
    </script>
</body>

</html>

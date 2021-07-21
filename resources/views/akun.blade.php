@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Account</h4>
                        <hr>
                        <div class="text-center">
                            @if(!empty(Auth::user()->avatar))
                            <img class="img-lg rounded-circle elevation-2 text-center" src="{{$avatar}}"
                                alt="profile image">
                            @else
                            <img class="border img-lg rounded-circle elevation-2 text-center"
                                src="{{asset('images/user/ava.png')}}" alt="profile image">
                            @endif

                            <p>

                                @if($badge == 'Bronze')
                                <span class="badge" style="background-color: #804A00; color: white;">{{$badge}}
                                    User</span>
                                @elseif($badge == 'Silver')
                                <span class="badge badge-secondary"
                                    style="background-color: #A8A9AD; color: white;">{{$badge}} User</span>
                                @elseif($badge == 'Gold')
                                <span class="badge badge-warning">{{$badge}} User</span>
                                @else
                                <span class="badge badge-info">{{$badge}} User</span>
                                @endif

                                <hr>

                                <h5>{{$akun->name}}<small> - <i class="mdi mdi-coin text-success"></i> {{$akun->point}}
                                        Points</small></h5>
                                @if($neededpoint !== 0)
                                <div class="progress" style="height:10%;">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped"
                                        role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        style="width:{{$progress}}%;">
                                        {{$progress}}%
                                    </div>
                                </div>
                                @endif
                        </div>
                        @if($neededpoint !== 0)
                        <small>
                            <i>*Diperlukan {{$neededpoint}} point lagi untuk mencapai
                                <strong>{{$nextbadge}}</strong></i>
                        </small>
                        @endif
                    </div>

                    <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_avatar"><b>Ubah Foto
                            Profile</b></a>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-3">
                            <h4 class="card-title mb-0">History Transaksi</h4>
                            <p class="mb-0 text-muted">{{$total_his}} Transaksi Sukses</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($histori as $data)
                            <li class="list-group-item" onclick="location.href = 'tagihan/{{$data->id}}';"><a class="text-success float-right">+40 Point</a>{{$data->kode_transaksi}} 
                            <br><strong>{{'Rp.'.number_format($data->grand_total,2,',','.')}}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Account Data</h4>
                    <hr>
                    <p>
                        <form method="POST" action="{{route('updatedatadiri')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-primary">
                                        <span class="input-group-text bg-transparent">
                                            <i class="mdi mdi-account-box-outline text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="name" class="form-control" value="{{$akun->name}}"
                                        required>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-warning">
                                        <span class="input-group-text bg-transparent">
                                            <i class="mdi mdi-shield-outline text-white"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password Baru">
                                </div>
                                <input type="checkbox" class="form-checkbox"> <small> Show password</small>

                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nomor Hp</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-danger">
                                        <span class="input-group-text bg-transparent">
                                            <i class="mdi mdi-phone text-white"></i>
                                        </span>
                                    </div>

                                    <input type="text" name="no_hp" class="form-control" placeholder="088111115555"
                                        value="{{$akun->no_hp}}">

                                </div>
                            </div>

                            <input type="submit" class="btn btn-success float-right" value="Simpan">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===============Modal upload avatar=================== -->

<div class="modal fade" id="modal_crop" tabindex="-1" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sesuaikan Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" class="img-sample">
                        </div>

                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="file" name="avatar_img" id="avatar_img" style="opacity: 0; height: 1px; display: none;"
                accept=".jpg, .png, .JPEG">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="myform" action="{{route('ubahfoto')}}" method="POST">
                    @csrf
                    <input type="hidden" id="base64image" name="base64image">
                    <input type="submit" id="simpan" class="btn btn-primary" value="Simpan">
                </form>
                <button id="crop" class="btn btn-success"
                    onclick="getElementById('crop').style.display = 'block'; this.style.display = 'none'">Crop</button>
            </div>
        </div>
    </div>
</div>

@endsection

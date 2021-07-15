@extends('layouts.app')

@section('content')
<div class="row">
    @foreach($kamar as $data)
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="inner">
                <img class="card-img-top" src="{{asset('/images/kamar/'.$data->gambar)}}" alt="gambar-kamar">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$data->nama}}</h5>
                <div class="row fixed">

                    <div class="col-md-6">
                        <p class="font-weight-normal">Tamu<p>
                                <ul style="list-style-type:none;">
                                    <li class="card-text"> <i class="mdi mdi-account-card-details text-danger"></i>
                                        {{$data->jumlah_tamu}} {{$data->tipe_tamu}}</li>
                                </ul>
                    </div>

                    <div class="col-md-6">
                        <p class="font-weight-normal">Tata Ranjang<p>
                                <ul style="list-style-type:none;">
                                    <li> <i class="mdi mdi-hotel text-primary"></i> {{$data->jumlah_bed}}
                                        {{$data->tipe_bed}}</li>
                                    <li> </li>
                                </ul>
                    </div>

                    <div class="col-md-6">
                        <p class="font-weight-normal">Fasilitas Kamar<p>
                                <ul style="list-style-type:none;">
                                    @if($data->wifi == 1)
                                    <li> <i class="mdi mdi-wifi text-success"></i> Wifi</li>
                                    @endif
                                    @if($data->tv == 1)
                                    <li> <i class="mdi mdi-television-guide text-success"></i> Tv</li>
                                    @endif
                                    @if($data->dvd == 1)
                                    <li> <i class="mdi mdi-play-pause text-success"></i> Dvd Player</li>
                                    @endif
                                    @if($data->ac == 1)
                                    <li> <i class="mdi mdi-air-conditioner text-success"></i> AC</li>
                                    @endif
                                    @if($data->sarapan == 1)
                                    <li> <i class="mdi mdi-silverware-variant text-success"></i> Sarapan</li>
                                    @endif
                                </ul>
                    </div>

                    <div class="col-md-6">
                        <p class="font-weight-normal">Fasilitas Utama<p>
                                <ul style="list-style-type:none;">
                                    @if($data->housekeeping == 1)
                                    <li> <i class="mdi mdi-broom text-warning"></i> Housekeeping</li>
                                    @endif
                                    @if($data->telephone == 1)
                                    <li> <i class="mdi mdi-phone-classic text-warning"></i> Telephone</li>
                                    @endif
                                </ul>
                    </div>

                </div>
                <hr>
                <div>
                    <div class="font-weight-bold card-text float-left"><small class="font-weight-bold">Harga</small>
                    </div>
                    <div class="font-weight-bold card-text float-right"><small class="text-weigt-bold text-danger">
                    {{'Rp.'.number_format($data->harga,2,',','.')}}</small><small class="text-muted"> <i>/malam</i></small></div>
                </div>
            </div>
            <button id="book" class="btn btn-primary" data-toggle="modal" data-target="#modal-booking"
                data-idkmr="{{$data->id}}" data-namakmr="{{$data->nama}}"
                data-hargakmr="{{$data->harga}}">Booking</button>
        </div>
    </div>
    @endforeach
</div>

<!-- ==========Modal Booking============== -->
<div class="modal fade" id="modal-booking">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Booking Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('bookingkamar')}}"" >
                 {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="id_tamu" value="{{Auth::user()->id}}">
                    <input type="hidden" class="form-control" id="harga_kmr"" placeholder=" Name">

                    <div class="form-group">
                        <label for="kamar">Kamar</label>
                        <input type="text" id="nama_kamar" name="nama_kamar" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" autocomplete="off">
                    </div>

                    <div class="hitunghari">
                        <div class="form-group">
                            <label for="exampleInputEmail3">Tanggal Cek In</label>
                            <input type="text" class="form-control" name="cek_in" id="cekin"
                                placeholder="Tanggal Cek in" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail3">Tanggal Cek Out</label>
                            <input type="text" class="form-control" name="cek_out" id="cekout"
                                placeholder="Tanggal Cek Out" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="kamar">jumlah hari</label>
                            <input type="text" class="form-control" name="jumlah_hari" id="jumlahhari" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama">Total Harga</label>
                        <input type="email" class="form-control" name="total_harga" id="total" placeholder="Total Harga"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Upload Ktp</label>
                        <input type="file" class="form-control" name="ktp" id="ktp" name="ktp">
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Booking">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ==============End of Modal=============== -->
@endsection

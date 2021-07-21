@section('js')

@stop
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-hotel text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Kamar</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{$jumlahkamar}}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-account mr-1" aria-hidden="true"></i> Kamar Yang dipesan
                </p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-sofa text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Ruangan</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">0</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Ruang dipesan
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-food text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">F&B Service</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{$jumlahmakanan}}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total Order List F&B
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-tshirt-crew text-success icon-lg" style="width: 40px;height: 40px;"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">Laundry</p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">0</h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-book mr-1" aria-hidden="true"></i> Total Transaksi Laundry
                </p>
            </div>
        </div>
    </div>
    
</div>
<!-- <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                <h6 class="card-title float-left font-weight-bold">Tagihan</h6>
                </div>
                <div class="col-md-6 text-center">
                <img src="{{asset('/images/logosh1.png')}}">
                <p>
                <p>Surabaya, Jawa Timur, Indonesia
                <p>Fax 982918
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-md-4">
                <h4 class="card-title font-weight-bold">Tanggal :</h4>
                <p>{{date('d-m-Y')}}
                </div>
                <div class="col-md-4">
                
                </div>
                <div class="col-md-4">
                <h4 class="card-title font-weight-bold">Kepada : </h4>
                <p>{{Auth::user()->name}}
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                    <thead>
                            <tr>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Tagihan</th>
                            </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">Food and Beverage Order List</h4>

                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                            <th>
                                    No.
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Harga
                                </th>
                                <th>
                                    Jumlah Beli
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Status
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($detilmakanan as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->restaurant->nama}}</td>
                                <td>{{'Rp.'.number_format($data->harga,2,',','.')}}</td>
                                <td>{{$data->jumlah}}</td>
                                <td>{{'Rp.'.number_format($data->total_harga,2,',','.')}}</td>
                                <td>
                                @if($data->status == 'Pesanan Disiapkan')
                                  <label class="badge badge-warning">Pesanan Disiapkan</label>
                                @elseif($data->status == 'Pesanan Dibuat')
                                  <label class="badge badge-primary">Pesanan Dibuat</label>
                                @else($data->status == 'Pesanan Diantar')
                                <label class="badge badge-success">Pesanan Dikirim</label>
                                @endif
                                
                                
                                </td>
                                
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

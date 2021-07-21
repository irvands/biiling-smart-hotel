@extends('layouts.app')

@section('content')

<div class="row">
@foreach($billing as $data)
    <div class="col-md-12  grid-margin stretch-card">
        
        <div class="card">
        <div class="card-header">{{$data->kode_transaksi}}</div>
            <div class="card-body"> 
            <a class="btn btn-primary float-right" href="tagihan/{{$data->id}}">Bayar</a>
            <h6>Jumlah Tagihan : </h6>
                <h6 class="text-success">{{'Rp.'.number_format($data->grand_total,2,',','.')}}</h6>    
            </div>
        </div>
        
    </div>
    @endforeach
</div>

@endsection

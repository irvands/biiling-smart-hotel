@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <h6 class="card-title float-left font-weight-bold">Tagihan</h6>
              
                    <table class="table table-striped" id="table">
                    <thead>
                            <tr>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th  class="text-right">Tagihan</th>
                            </tr>

                            @if($tagihankamar !== 0)
                            @foreach($transaksikamar as $data)
                            <tr>
                            <td>{{$data->kamar->nama}}</td>
                            <td>{{$data->jumlah_hari}}</td>
                            <td class="text-right">{{'Rp.'.number_format($data->total_harga,2,',','.')}}</td>
                            </tr>
                            @endforeach
                            <tr>
                            <th colspan="2" class="text-center font-weight-bold">TOTAL TAGIHAN KAMAR</th>
                            
                            <th class="text-right font-weight-bold">{{'Rp.'.number_format($tagihankamar,2,',','.')}}</th>
                            </tr>
                            @endif

                            @if($tagihanrestaurant !== 0)
                            @foreach($transaksirestaurant as $data)
                            <tr>
                            <td>{{$data->restaurant->nama}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td class="text-right">{{'Rp.'.number_format($data->total_harga,2,',','.')}}</td>
                            </tr>
                            @endforeach
                            <tr>
                            <th colspan="2" class="text-center font-weight-bold">TOTAL TAGIHAN F&B</th>
                            
                            <th class="text-right font-weight-bold">{{'Rp.'.number_format($tagihanrestaurant,2,',','.')}}</th>
                            </tr>
                            @endif

                            <tr>
                            <th colspan="2" class="text-center font-weight-bold">GRAND TOTAL</th>
                            
                            <th class="text-right font-weight-bold">{{'Rp.'.number_format($grandtotal,2,',','.')}}</th>
                            </tr>
                    </table>
                    <hr>
                    <div class="act-button float-right">
                        <form id="selesaikan" action="{{route('selesaikan')}}" method="POST">
                        @csrf
                        <input type="hidden" name="tagihan_kamar" id="totalkamar" value="{{$tagihankamar}}">
                        <input type="hidden" name="tagihan_fnb" id="totalfnb" value="{{$tagihanrestaurant}}">
                        <input type="hidden" name="grand_total" id="grand_total" value="{{$grandtotal}}">
                        </form>
                      
                        <button class="btn btn-success" id="btn-submit">Selesaikan Transksi</button>
                       
                        
                        
                    <div>
                </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection
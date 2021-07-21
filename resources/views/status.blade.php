@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8  grid-margin stretch-card">
        <div class="card">
        <div class="card-header">
           Status Pembayaran
        </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Virtual Account&emsp;&emsp;&emsp;&emsp;&emsp;</td>
                        <td>:&emsp;&emsp;&emsp;&emsp;&emsp;</td>
                        <td>{{$va}}</td>
                    </tr>

                    <tr>
                        <td>Bank</td>
                        <td>:</td>
                        <td>{{$bank}}</td>
                    </tr>

                    <tr>
                        <td>Total Tagihan</td>
                        <td>:</td>
                        <td>{{'Rp.'.number_format($total,2,',','.')}}</td>
                       
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        @if($status == 'pending')
                        <td><span class="badge badge-warning">{{$status}}</span></td>
                        @elseif($status == 'settlement')
                        <td><span class="badge badge-success">Sukses</span></td>
                        @elseif($status == 'failure')
                        <td><span class="badge badge-danger">Gagal</span></td>
                        @endif
                    </tr>
                    
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>{{$time}}</td>
                    </tr>
                    
                    <tr>
                        <td>Berlaku Hingga</td>
                        <td>:</td>
                        <td>{{$deadline}}</td>
                    </tr>
                </table>
                <hr>
                @if($status == 'settlement')
                <a class="btn btn-success text-white" href="{{route('cetakbil')}}"><i class="mdi mdi-printer"></i>Cetak Nota</a>
                @endif
            </div>
        </div>

    </div>

</div>

@endsection

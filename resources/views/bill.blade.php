<!DOCTYPE html>
<html>
<head>
	<title>Bukti Pembayaran Smart Hotel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
	<center>
		<h2>Bukti Pembayaran Tagihan Smart Hotel</h2>
		
	</center>
<hr>
Kepada : {{Auth::user()->name}}
<p>Pembayaran : LUNAS
    <table id="customers">
        <tr>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Tagihan</th>

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
        </tr>
    </table>
    <!-- <table class="table table-striped" id="table">
                    <thead>
                            <tr>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th  class="text-right">Tagihan</th>
                            </tr>
                    </thead>
                    <tbody>

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
                            <t/body>
                    </table>
                    <hr>
                    <div class="act-button float-right">
                        <h4>Pembayaran LUNAS</h4>
                    <div>
                </div>
	 -->

</body>
</html>
<div class="row">
    @foreach($dessert as $data)
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card" style="width: 18rem;">
            <div class="inner">
                <img class="card-img-top img-responsive" src="{{asset('images/restaurant/'.$data->gambar)}}"
                    alt="Card image cap">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">{{$data->nama}}</h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title float-right text-success">{{'Rp.'.number_format($data->harga,2,',','.')}}</h5>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="{{route('pesanmakan')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="id_makanan" value="{{$data->id}}">
                        <input type="hidden" class="form-control" name="harga" value="{{$data->harga}}">
                        <div class="form-group">
                            <div class="input-group">
                                <input id="counter" class="form-control" name="jumlah" id="counter" class="counter"
                                    type="number" value="0" style="text-align: center;" autocomplete="off">
                            </div>
                        </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="pesan">
            </form>
        </div>
    </div>
    @endforeach
</div>

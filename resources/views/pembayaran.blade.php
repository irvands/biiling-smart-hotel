@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8  grid-margin stretch-card">
        <div class="card">
        <div class="card-header">
            Ketentuan Pembayaran
        </div>
            <div class="card-body">
            <small>Sebelum melanjutkan pembayaran Pelanggan Smart Hotel diwajibkan untuk membaca beberapa
            ketentuan yang berlaku,adapun ketentuannya sebagai berikut:</small>
            <p>
            <ol>
                <li>Pelanggan dibebaskan memilih metode pembayaran yang diinginkan</li>
                <li>Pembayaran otomatis akan hangus jika melebihi batas waktu yang ditentukan</li>
                <li>Semua pembayaran yang sudah berhasil tidak bisa dikembalikan(refund)</li>
                <li>Smart Hotel tidak bertanggung jawab apabila terjadi kesalahan yang disebabkan oleh kelalaian pelanggan</li>
                <li>Smart Hotel tidak bertanggung jawab atas semua bentuk penyalahgunaan kartu kredit</li>
            <ol>

            <div class="col-md-6">
            
            </div>
            <hr>
            <input type="checkbox" id="ketentuan" onchange="document.getElementById('pay-button').disabled = !this.checked;"> Saya setuju dan lanjutkan
            <hr>
            <button class="btn btn-primary" id="pay-button" disabled>Bayar</button>
                <form method="get" id="payment-form" action="payment">
                    <input type="hidden" name="result_data" id="result-data" value="">
                </form>
            </div>
        </div>

    </div>


    <script type="text/javascript">

    document.getElementById('pay-button').onclick = function () {
        // SnapToken acquired from previous step
        snap.pay('<?php echo $snapToken?>', {
            // Optional
            onSuccess: function (result) {
                document.getElementById('result-data').val(JSON.stringify(result, null, 2));
                $('#payment-form').submit();
            },
            // Optional
            onPending: function (result) {
                $('#result-data').val(JSON.stringify(result, null, 2));
                $('#payment-form').submit();
            },
            // Optional
            onError: function (result) {
                document.getElementById('result-data').val(JSON.stringify(result, null, 2));
                $('#payment-form').submit();
            }
        });
    };

</script>

</div>

@endsection

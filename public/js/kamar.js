$('body').on('click', '#book', function (event) {
    var namakamar = $(this).data('namakmr');
    var idkamar = $(this).data('idkmr');
    var hargakamar = $(this).data('hargakmr');
    $("#nama_kamar").val(namakamar);
    $("#id_kmr").val(idkamar);
    $("#harga_kmr").val(hargakamar);

    $("#cekin").datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
    
    $("#cekout").datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
    
    $(document).on("change", ".hitunghari", function(){
        var cekin = new Date($("#cekin").val());
        var cekout = new Date($("#cekout").val());
    
        var selisihWaktu = cekout.getTime() - cekin.getTime();
    
        var ms = 1000;
        var s = 3600;
        var h = 24;
    
        var selisihHari = selisihWaktu / (ms * s * h);
        if(isNaN(selisihHari)){
            selisihHari  = 0;
        }
        $("#jumlahhari").val(selisihHari + " hari");

        var totalharga = selisihHari * hargakamar;
        $("#total").val(totalharga)
    });


});


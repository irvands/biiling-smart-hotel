<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksikamar;
use App\Models\Billing;
use Auth;
use Alert;
use App\Models\Transaksirestaurant;

class TagihanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public $snapToken;
    // public function bayar(){
       
    //    }
   
   public function index(){
	
    $id = Auth::user()->id;
    $transaksikamar = Transaksikamar::all()->where('id_tamu',$id);
    $transaksirestaurant = Transaksirestaurant::orderBy('updated_at','DESC')->where('id_tamu',$id)->get();

    $tagihankamar = Transaksikamar::where('id_tamu',$id)->sum('total_harga');
    $tagihanrestaurant = Transaksirestaurant::where('id_tamu',$id)->sum('total_harga');
    $grandtotal = $tagihanrestaurant + $tagihankamar;

    $cekbill = Billing::where([['id_tamu',$id],['status',1]])->get();
   
    $trans_id = Billing::select('id')->where([['id_tamu',$id],['status',1]])->get();
    $amount = Billing::select('grand_total')->where([['id_tamu',$id],['status',1]])->get();

    \Midtrans\Config::$serverKey = 'SB-Mid-server-o__eVCQ3xNUEnA-279hlzVzc';
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;
    

    //cek apakah user punya transaksi yang belum dipilih metodenya
    if(!$cekbill->isEmpty()){
    $params = array(
        'transaction_details' => array(
            'order_id' => $trans_id[0]['id'],
            'gross_amount' => $amount[0]['grand_total'],
        ),
        'customer_details' => array(
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->no_hp,
        ),
    );
    //jika ada tampilkan snaptoken nya
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    }else{
        $params = array(
            'transaction_details' => array(
                'order_id' => 1,
                'gross_amount' => 1,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
    //jika tidak (kondisi ini tidak akan terjadi karena apabila user tidak punya transaksi tombol bayar tdk muncul)
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }
    
    return view('tagihan',['transaksikamar'=>$transaksikamar,
    'transaksirestaurant'=>$transaksirestaurant,
    'tagihankamar'=>$tagihankamar,
    'tagihanrestaurant'=>$tagihanrestaurant,
    'grandtotal'=>$grandtotal,
    'snaptoken'=>$snapToken,
    'cekbill'=>$cekbill]);
   }

   public function endtrans(Request $request){
    
    $id = Auth::user()->id;
    $kode = "#BIL-".$id.mt_rand(1000,9999);
    $tagihan_kamar = $request->tagihan_kamar;
    $tagihan_fnb = $request->tagihan_fnb;
    $tagihan_ruang = '0';
    $tagihan_laundry =  '0';
    $grand_total = $request->grand_total;
    $status = "1" ;

    $pemasukan =  Billing::create(['id_tamu'=>$id,
    'kode_transaksi'=>$kode,
    'tagihan_kamar'=>$tagihan_kamar,
    'tagihan_fnb'=>$tagihan_fnb,
    'tagihan_ruang'=>$tagihan_ruang,
    'tagihan_laundry'=>$tagihan_laundry,
    'grand_total'=>$grand_total,
    'status'=>$status]);

    Alert::success('Success', 'Silahkan Melakukan Pembayaran !');
    return back();
   }

   public function bayar(){

    
   }
}

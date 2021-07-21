<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksikamar;
use App\Models\Billing;
use App\Models\User;
use Auth;
use PDF;
use Alert;
use App\Models\Transaksirestaurant;

class TagihanController extends Controller
{
    private $snapToken;
    public function __construct()
    {
        $this->middleware('auth');
        $this->snapToken;
    }
   
   public function index(){
	
    $id = Auth::user()->id;
    $transaksikamar = Transaksikamar::all()->where('id_tamu',$id);
    $transaksirestaurant = Transaksirestaurant::orderBy('updated_at','DESC')->where('id_tamu',$id)->get();

    $tagihankamar = Transaksikamar::where('id_tamu',$id)->sum('total_harga');
    $tagihanrestaurant = Transaksirestaurant::where('id_tamu',$id)->sum('total_harga');
    $grandtotal = $tagihanrestaurant + $tagihankamar;

    $cekbill = Billing::where([['id_tamu',$id],['status',1]])->get();

    return view('tagihan',['transaksikamar'=>$transaksikamar,
    'transaksirestaurant'=>$transaksirestaurant,
    'tagihankamar'=>$tagihankamar,
    'tagihanrestaurant'=>$tagihanrestaurant,
    'grandtotal'=>$grandtotal,
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
    $status = "0" ;

    $pemasukan =  Billing::create(['id_tamu'=>$id,
    'kode_transaksi'=>$kode,
    'tagihan_kamar'=>$tagihan_kamar,
    'tagihan_fnb'=>$tagihan_fnb,
    'tagihan_ruang'=>$tagihan_ruang,
    'tagihan_laundry'=>$tagihan_laundry,
    'grand_total'=>$grand_total,
    'status'=>$status]);

    Alert::success('Success', 'Silahkan Melakukan Pembayaran !');
    return redirect('list-tagihan');
   }

   public function bayar($id){
    $billing = Billing::find($id);
    $stat = Billing::select('status')->where('id',$id)->get();
    
    
    \Midtrans\Config::$serverKey = 'SB-Mid-server-o__eVCQ3xNUEnA-279hlzVzc';
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    if(isset($_GET['result_data'])){
        $current_status = json_decode($_GET['result_data'], true);
        $id             = $current_status['order_id'];
        Billing::where('id',$id)->update(['status'=>'2']);
        return back();
    }else{
        $billing = Billing::find($id);
    }

        if($stat[0]['status'] == '0'){
        $params = array(
            'transaction_details' => array(
                'order_id' => $billing->id,
                'gross_amount' => $billing->grand_total,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_hp,
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('pembayaran',['snapToken'=>$snapToken]);
    }else if($stat[0]['status'] == '2' || $stat[0]['status'] == '3'){
        $status =  \Midtrans\Transaction::status($billing->id);
        $status = json_decode(json_encode($status), true);

        $va_number = $status['va_numbers'][0]['va_number'];
        $gross_amount = $status['gross_amount'];
        $bank = $status['va_numbers'][0]['bank'];
        $transaction_status = $status['transaction_status'];
        $transaction_time = $status['transaction_time'];
        $deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));

        if($status['transaction_status'] == 'settlement'){
            $id = Auth::user()->id;
            $current_reward = Auth::user()->point;
            $reward = $current_reward + 50;
            User::where('id',$id)->update(['point'=>$reward]);
            Billing::where('id',$billing->id)->update(['status'=>3]);
            
        }
        return view('status',['bank'=>$bank,
        'total'=>$gross_amount,
        'va'=>$va_number,
        'time'=>$transaction_time,
        'status'=>$transaction_status,
        'deadline'=>$deadline,
        ]);
    }
    }

    public function cetakbil(){
        $id = Auth::user()->id;
        $transaksikamar = Transaksikamar::all()->where('id_tamu',$id);
        $transaksirestaurant = Transaksirestaurant::orderBy('updated_at','DESC')->where('id_tamu',$id)->get();

        $tagihankamar = Transaksikamar::where('id_tamu',$id)->sum('total_harga');
        $tagihanrestaurant = Transaksirestaurant::where('id_tamu',$id)->sum('total_harga');
        $grandtotal = $tagihanrestaurant + $tagihankamar;

        $pdf = PDF::loadview('bill',['transaksikamar'=>$transaksikamar,
        'transaksirestaurant'=>$transaksirestaurant,
        'tagihankamar'=>$tagihankamar,
        'tagihanrestaurant'=>$tagihanrestaurant,
        'grandtotal'=>$grandtotal]);

    	return $pdf->download('billing-smarthotel');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Restaurant;
use App\Models\Transaksirestaurant;
use RealRashid\SweetAlert\Facades\Alert;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
       $restaurant = Restaurant::all();
       $apetizer =  Restaurant::where('kategori', 'appetizer')->get();
       $mc =  Restaurant::where('kategori', 'maincourse')->get();
       $dessert = Restaurant::where('kategori', 'dessert')->get();
       
       return view('restaurant.index',
       ['restaurant'=>$restaurant,
       'apetizer' =>$apetizer,
       'mc' =>$mc,
       'dessert'=>$dessert
       ]); 
    }

    public function pesan(Request $request){
        $id_tamu = Auth::user()->id;
        $cek = Transaksirestaurant::where([['id_tamu',$id_tamu],['id_makanan',$request->id_makanan],['status','Pesanan Disiapkan']])->get();

        $jmlh = $request->jumlah; 
        if($jmlh == 0){
            Alert::toast('Jumlah Minimum Order Kurang !');
            return back();

        }else{

            if(!$cek->isEmpty()){
               $jumlahlama = $cek[0]->jumlah;
               $jumlahbaru = $jumlahlama + $request->jumlah;
               $totalharga = $jumlahbaru * $request->harga;
               
               Transaksirestaurant::where([['id_tamu',$id_tamu],['id_makanan',$request->id_makanan],['status','Pesanan Disiapkan']])->update(['jumlah'=>$jumlahbaru,'total_harga'=>$totalharga]);
               Alert::success('Success', 'Transaksi Berhasil Ditambahkan !');
               return redirect('/home');
            }else{
                $this->validate($request,[
                    'id_makanan' => 'required',
                    'harga' => 'required',
                    'jumlah' => 'required'
                ]);
                
                $kode = "#TR-R".mt_rand(1000,9999);
        
                $hargasatuan = $request->harga;
                $jmlhbeli = $request->jumlah;
                $totalharga = $hargasatuan * $jmlhbeli;
        
                $status = "Pesanan Disiapkan";
                Transaksirestaurant::create([
                    'kode_transaksi' => $kode,
                    'id_tamu' => $id_tamu,
                    'id_makanan' => $request->id_makanan,
                    'harga' => $request->harga,
                    'jumlah' => $request->jumlah,
                    'total_harga' => $totalharga,
                    'status' => $status
                ]);
        
                Alert::success('Success', 'Transaksi Berhasil Ditambahkan !');
                return redirect('/home');
            }
            }

            
        
     }
}

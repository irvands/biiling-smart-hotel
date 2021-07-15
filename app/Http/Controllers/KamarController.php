<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Kamar;
use App\Models\Transaksikamar;
use RealRashid\SweetAlert\Facades\Alert;

class KamarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $kamar = Kamar::all();
       return view('kamar', ['kamar' => $kamar]); 
    }

    public function booking(Request $request){
        $this->validate($request,[
            'id_tamu' => 'required',
            'nama_kamar' => 'required',
            'nama' => 'required',
            'cek_in' => 'required',
            'cek_out' => 'required',
            'total_harga'  => 'required',
            'ktp'  => 'required',
    	]);
 
        // dd($request->all());

        $namakamar = $request->nama_kamar;
        $isnama = Kamar::select('id')->where('nama',$namakamar)->first();
        print_r($isnama);
        $kode = "#TR-".mt_rand(1000,9999);
        Transaksikamar::create([
            'kode_transaksi' => $kode,
            'id_tamu' => $request->id_tamu,
            'id_kamar' => $isnama->id,
            'nama' => $request->nama,
            'cek_in' => $request->cek_in,
            'cek_out' => $request->cek_out,
            'total_harga' => $request->total_harga,
            'ktp' => $request->ktp
        ]);

        

       
        Alert::success('Success', 'Transaksi Berhasil Ditambahkan !');
        return redirect('/home');
        
       
    }
}

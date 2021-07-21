<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksikamar;
use App\Models\Transaksirestaurant;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $jumlahkamar = Transaksikamar::where('id_tamu', $id)->count();
        $jumlahmakanan = Transaksirestaurant::where('id_tamu', $id)->count();

        $detilmakanan = Transaksirestaurant::orderBy('updated_at','DESC')->where('id_tamu', $id)->get();
        return view('home',['jumlahkamar' => $jumlahkamar,
        'jumlahmakanan' => $jumlahmakanan,
        'detilmakanan' => $detilmakanan
        ]);
    }
    public function mt(){
        return view('mt');
    }
}

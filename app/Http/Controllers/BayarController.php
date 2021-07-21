<?php

namespace App\Http\Controllers;
use App\Models\Billing;
use Auth;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    public function index(){

        $id = Auth::user()->id;
        $billing = Billing::orderBy('id','DESC')->where('id_tamu',$id)->get();

        // print_r($billing);
        return view('list-tagihan',['billing'=>$billing]);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Billing;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AkunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $id = Auth::user()->id;
        $histori = Billing::where([['id_tamu',$id],['status',3]])->get();
        $total_histori = Billing::where([['id_tamu',$id],['status',3]])->count();

        $akun = User::where('id', $id)->first();

        $ava = $akun->avatar;
        if(preg_match('@^https?://@', $ava)){
            $avatar = $ava;
        }else{
            $avatar = asset('images/user/'.$ava);
        }

        $minsilver = 101;
        $mingold = 501;
        $mindiamod = 1001;
       
        if($akun->point<=100){
            $badge = 'Bronze';
            $neededpoint = $minsilver - $akun->point;
            $nextbadge = 'Silver';
            $progress = ($akun->point / 100) * 100;
        }else if($akun->point>100 && $akun->point<=500){
            $badge = 'Silver';
            $neededpoint = $mingold - $akun->point;
            $nextbadge = 'Gold';
            $progress = ($akun->point / 500) * 100;
        }else if($akun->point>500 && $akun->point<=1000){
            $badge = 'Gold';
            $neededpoint = $mindiamod - $akun->point;
            $nextbadge = 'Platinum';
            $progress = ($akun->point / 1000) * 100;
        }else{
            $badge = 'Platinum';
            $neededpoint = 0;
            $nextbadge = '';
            $progress = 0;
        }

        return view('akun',['akun' => $akun, 'badge' => $badge,
         'neededpoint' => $neededpoint,
          'nextbadge' => $nextbadge,
          'progress' => $progress,
          'avatar' => $avatar,
          'histori' => $histori,
          'total_his'=>$total_histori]
        );
    }

    public function editavatar(Request $request){
        $id =  Auth::user()->id;
        $oldavatar = Auth::user()->avatar;
        $path = public_path('images/user/');
        $input = $request->all();
    
        $avatar_part = explode(";base64,",$input['base64image']);
        $avatar_type_aux = explode("image/",$avatar_part[0]);
        $avatar_type = $avatar_type_aux[1];
        $avatar_base64 = base64_decode($avatar_part[1]);

        $randcode = mt_rand(1000,9999);
        $avatarname = $randcode.$id.date('d-m-y').'.'.$avatar_type;
        $file = $path.$avatarname;
        file_put_contents($file,$avatar_base64);
            
        User::where('id',$id)->update(['avatar'=>$avatarname]);
            
  
        // dd($request->all());
        Alert::toast('Foto Berhasil di Update !');
        return back();
      }

      public function updatedatadiri(Request $request){
        $validate = Validator::make($request->all(), [
            'nama' => ['required','alpha'],
            'no_hp' => ['required','numeric','max:13'],
        ]);

        $id =  Auth::user()->id;
        $name = $request->name;
        $password = $request->password;
        $encrypt_password = Hash::make($password);
        $no_hp = $request->no_hp;

        User::where('id',$id)->update(['name'=>$name, 'password'=>$encrypt_password, 'no_hp'=>$no_hp]);
        Alert::toast('Data Berhasil di Update !');
        return back();
        // print_r($encrypt_password);
        // dd($request->all());
      }
    
}

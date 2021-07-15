<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksirestaurant extends Model
{
    use HasFactory;

    protected $table = "transaksirestaurants";

    protected $fillable = [
        'kode_transaksi',
        'id_tamu',
        'id_makanan',
        'jumlah',
        'harga',
        'total_harga',
        'status'
    ];

    public function tamu(){
        return $this->belongsTo('App\User', 'id_tamu');
    }

    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant', 'id_makanan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $table = "billing";

    protected $fillable = [
        'kode_transaksi',
        'id_tamu',
        'tagihan_kamar',
        'tagihan_fnb',
        'tagihan_ruang',
        'tagihan_laundry',
        'grand_total',
        'status'
    ];


    public function tamu(){
        return $this->belongsTo('App\User', 'id_tamu');
    }
}

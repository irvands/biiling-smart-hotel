<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksikamar extends Model
{
    use HasFactory;

    protected $table = "transaksikamar";

    protected $fillable = [
        'kode_transaksi',
        'id_tamu',
        'id_kamar',
        'nama',
        'cek_in',
        'cek_out',
        'ktp',
        'total_harga'
    ];

    public function tamu(){
        return $this->belongsTo('App\User', 'id_tamu');
    }

    public function kamar(){
        return $this->belongsTo('App\Kamar', 'id_kamar');
    }
}

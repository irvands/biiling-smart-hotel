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
        'jumlah_hari',
        'total_harga'
    ];

    public function tamu(){
        return $this->belongsTo('App\Models\User', 'id_tamu');
    }

    public function kamar(){
        return $this->belongsTo('App\Models\Kamar', 'id_kamar');
    }
}

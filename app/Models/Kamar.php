<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Kamar extends Model
{
    protected $table = "kamar";
    
    protected $fillable = [
        'nama',
        'jumlah_bed',
        'tipe_bed',
        'jumlah_tamu',
        'tipe_tamu',
        'wifi',
        'tv',
        'dvd',
        'ac',
        'sarapan',
        'housekeeping',
        'telephone',
        'harga',
        'gambar',
    ];
    
    use HasFactory;

    public function transaksikamar(){
        return $this->hashMany('App\Transaksikamar');
    }
}

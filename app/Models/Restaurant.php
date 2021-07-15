<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = "restaurant";
    
    protected $fillable = [
        'nama',
        'kategori',
        'harga',
        'gambar',
    ];
    
    use HasFactory;

    public function transaksirestaurant(){
        return $this->hashMany('App\Transaksirestaurant');
    }
}

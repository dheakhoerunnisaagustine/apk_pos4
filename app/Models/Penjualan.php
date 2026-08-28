<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ItemPenjualan;
use App\Models\User;


class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable= [
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'status'
    ];


    public function kasir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function ItemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }


    public function details()
    {
        return $this->hasMany(ItemPenjualan::class);
    }

}

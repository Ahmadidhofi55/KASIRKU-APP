<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [

        'qr_produk',
        'qr_img',
        'member_id',
        'user_id',
        'total_harga'

    ];
}

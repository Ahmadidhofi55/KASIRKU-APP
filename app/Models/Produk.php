<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [

        'supliyer_id',
        'qr_produk',
        'qr_img',
        'merek_id',
        'jenis_id',
        'stok',
        'harga_jual',
        'harga_beli',
        'diskon',
        'tgl_exp',

    ];
}

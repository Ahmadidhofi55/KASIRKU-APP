<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [

        'qr_produk',
        'qr_img',
        'merek_id',
        'jenis_id',
        'stok',
        'harga_jual',
        'harga_beli',
        'diskon',
        'supliyer_id',
        'tgl_exp',

    ];
}

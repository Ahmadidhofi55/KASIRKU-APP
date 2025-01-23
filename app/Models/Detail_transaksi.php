<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{
    use HasFactory;

    protected $fillable = [

        'transaksi_id',
        'produk_id',
        'pmb_id',
        'jumlah',
        'harga_satuan',
        'kembalian',
        'diskon',
        'subtotal'

    ];
}

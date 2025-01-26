<?php

namespace App\Models;

use App\Models\Merek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'qr_produk',
        'qr_img',
        'img',
        'merek_id',
        'jenis_id',
        'supliyer_id',
        'stok',
        'harga_jual',
        'harga_beli',
        'diskon',
        'tgl_exp',

    ];

    public function merek()
    {
        return $this->belongsTo(Merek::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function supliyer()
    {
        return $this->belongsTo(Supliyer::class);
    }
}

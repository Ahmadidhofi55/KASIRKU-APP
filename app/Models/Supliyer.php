<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supliyer extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'no_hp',
        'alamat'

   ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Mengizinkan kolom-kolom ini diisi ke MySQL
    protected $fillable = [
        'name',
        'category',
        'status',
        'image',
    ];
}
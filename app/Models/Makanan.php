<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'qty',
        'image'
    ];
    // protected $table = 'makanans';
}

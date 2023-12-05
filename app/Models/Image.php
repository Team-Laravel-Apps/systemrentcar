<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'tbl_image';
    public $timestamps = false;
    protected $fillable = [
        'id_image',
        'id_car',
        'gambar'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $table = 'tbl_cars';
    protected $fillable = [
        'id_car',
        'id_category',
        'nama_kendaraan',
        'img_kendaraan',
        'biaya_sewa',
        'unit',
        'description',
        'status_car'
    ];
}

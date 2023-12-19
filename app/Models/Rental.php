<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $table = 'tbl_rental';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_rental',
        'id_pelanggan',
        'car_id',
        'start_date',
        'end_date',
        'qty',
        'biaya',
        'status_rental'
    ];
}

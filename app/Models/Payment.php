<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'tbl_payment';
    public $timestamps = false;
    protected $fillable = [
        'id_payment',
        'id_transaction',
        'payment_amount',
        'payment_date',
        'payment_image'
    ];
}

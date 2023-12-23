<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_transaction',
        'id_rental',
        'payment_amount',
        'payment_date',
        'payment_method',
        'is_complete',
    ];
}

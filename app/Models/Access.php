<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'access';
    public $timestamps = false;
    protected $fillable = [
        'id_access',
        'nama_access',
        'id_role'
    ];
}

<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index($id_car)
    {
        if(auth()->user()->nik == null && auth()->user()->alamat == null && auth()->user()->alamat == null)
        {
            return view('homepage.profile');
        }else{
            return view('homepage.pesan');
        }
    }
}

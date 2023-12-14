<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SyaratController extends Controller
{
    public function index()
    {
        return view('homepage.syarat');
    }
}

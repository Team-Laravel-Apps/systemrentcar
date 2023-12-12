<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Cars;
use App\Models\Category;

class CarController extends Controller
{
    public function index()
    {
        $data = [
            'mobil' => Cars::all()
        ];

        return view('mobil', $data);
    }


    public function create()
    {
        $data = [
            'aksi' => 'Tambah Kendaraan',
            'kategori' => Category::all(),
        ];

        return view('form.formcar', $data);
    }

    public function posts(Request $request)
    {
        dd($request->all());
    }

}

<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cars;
use App\Models\Category;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'cars' => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('status_car', 'tersedia')
            ->paginate(12),

            'kategori' => Category::all(),
        ];

        return view('homepage.produk', $data);
    }

    public function detail($id_car)
    {
        $data = [
            'detail'  => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('id_car', $id_car)
            ->first()
        ];

        return view('homepage.detailproduk', $data);
    }
}

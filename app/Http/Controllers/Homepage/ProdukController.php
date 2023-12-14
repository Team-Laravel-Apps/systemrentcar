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
            'car' => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('status_car', 'tersedia')
            ->paginate(2),

            'kategori' => Category::all(),
        ];

        return view('homepage.produk', $data);
    }

    public function detail($id)
    {
        $data = [
            'detail'       => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')->find($id)
        ];

        return view('homepage.detailproduk', $data);
    }
}

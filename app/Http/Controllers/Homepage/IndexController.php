<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cars;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $data = [
            'car' => Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('status_car', 'tersedia')
            ->get(),

            'kategori' => Category::all(),
        ];

        return view('homepage.index', $data);
    }
}

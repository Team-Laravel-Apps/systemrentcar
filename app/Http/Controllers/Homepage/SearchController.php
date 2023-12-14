<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cars;
use App\Models\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $car = Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
                ->where('nama_kendaraan', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('transmisi', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('kapasitas', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('biaya_sewa', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('categories.category', 'LIKE', '%' . $searchTerm . '%')
                ->paginate(2);

        $kategori = $car->map(function ($m) {
            return Category::where('id_category', '=', $m->id_category)->first();
        });

        return view('homepage.produk', compact('car', 'kategori'));

    }
}

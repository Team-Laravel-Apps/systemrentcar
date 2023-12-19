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

        $carQuery = Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('nama_kendaraan', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('transmisi', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('kapasitas', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('biaya_sewa', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('categories.category', 'LIKE', '%' . $searchTerm . '%');

        $cars = $carQuery->paginate(12);

        // Menambahkan nilai pencarian ke setiap link paginate
        $cars->appends(['search' => $searchTerm]);

        if ($searchTerm) {
            $categoryIds = $cars->pluck('id_category')->unique()->toArray();
            $kategori = Category::whereIn('id_category', $categoryIds)->get();
        } else {
            // Jika pencarian kosong, tampilkan semua data
            $kategori = Category::all();
        }

        return view('homepage.produk', compact('cars', 'kategori'));
    }

    public function category(Request $request, $id_category)
    {

          $carQuery = Cars::join('categories', 'categories.id_category', '=', 'tbl_cars.id_category')
            ->where('tbl_cars.id_category', $id_category);

        $cars = $carQuery->paginate(12);


        // $categoryIds = $cars->pluck('id_category')->unique()->toArray();
        $kategori = Category::where('id_category', $id_category)->get();


        return view('homepage.produk', compact('cars', 'kategori'));
    }
}

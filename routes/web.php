<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Homepage\IndexController;
use App\Http\Controllers\Homepage\KeranjangController;
use App\Http\Controllers\Homepage\KontakController;
use App\Http\Controllers\Homepage\PesanController;
use App\Http\Controllers\Homepage\ProdukController;
use App\Http\Controllers\Homepage\ProfileController;
use App\Http\Controllers\Homepage\RiwayatController;
use App\Http\Controllers\Homepage\SearchController;
use App\Http\Controllers\Homepage\SyaratController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function(){
    //page
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::get("/register", [RegisterController::class, "index"])->name("register");

    //action
    Route::post("login/post", [LoginController::class, "posts"])->name('posts.login');
    Route::post("register/post", [RegisterController::class, "posts"])->name('posts.register');
});

Route::middleware('auth')->group(function(){
    Route::get("/profile/{id}", [UsersController::class, "update"])->name("up.profile");
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
    Route::get("/role-users", [RoleController::class, "index"])->name("role");

    Route::get("/usersmanager", [UsersController::class, "index"])->name("users");
    Route::get("/usersmanager/add", [UsersController::class, "create"])->name("add.users");
    Route::get("/usersmanager/up/{id}", [UsersController::class, "update"])->name("up.users");


    Route::get("/kategori", [CategoriesController::class, "index"])->name("kategori");
    Route::get("/kategori/add", [CategoriesController::class, "create"])->name("add.kategori");
    Route::get("/kategori/up/{id_category}", [CategoriesController::class, "update"])->name("up.kategori");

    Route::get("/data-kendaraan", [CarController::class, "index"])->name("mobil");
    Route::get("/data-kendaraan/add", [CarController::class, "create"])->name("add.mobil");
    Route::get("/data-kendaraan/up/{id}", [CarController::class, "update"])->name("up.mobil");

    Route::get("/pelanggan", [PelangganController::class, "index"])->name("pelanggan");
    Route::get("/transaksi/pendding", [TransaksiController::class, "pendding"])->name("transaksi.pendding");
    Route::get("/transaksi/proses", [TransaksiController::class, "proses"])->name("transaksi.proses");
    Route::get("/transaksi/selesai", [TransaksiController::class, "selesai"])->name("transaksi.selesai");
    Route::get("/transaksi/dibatalkan", [TransaksiController::class, "batal"])->name("transaksi.batal");

    Route::get("/transaksi/laporan", [TransaksiController::class, "laporan"])->name("transaksi.laporan");
    Route::get("/transaksi/invoice", [InvoiceController::class, "index"])->name("invoice");
});



//Logout
Route::match(['get', 'post'], "logout/post", [LogoutController::class, "posts"])->name('posts.logout');

Route::middleware('auth')->group(function(){
    //Create
    Route::post("role/post", [RoleController::class, "posts"])->name('posts.role');

    // Update
    Route::post("role/update", [RoleController::class, "update"])->name('update.role');

    //Delete
    Route::get('role/delete/{id_role}', [RoleController::class, 'delete'])->name('delete.role');
    Route::get('usersmanager/delete/{id}', [UsersController::class, 'delete'])->name('delete.users');
    Route::get('kategori/delete/{id_category}', [CategoriesController::class, 'delete'])->name('delete.kategori');


    //Post and Update
    Route::post("users/post", [UsersController::class, "posts"])->name('posts.users');
    Route::post("kategori/post", [CategoriesController::class, "posts"])->name('posts.kategori');
    Route::post("cars/post", [CarController::class, "posts"])->name('posts.car');
});


// Pelanggan
Route::get("/", [IndexController::class, "index"])->name("home");
Route::get("/produk-kami", [ProdukController::class, "index"])->name("produk");
Route::get("/syarat-ketentuan", [SyaratController::class, "index"])->name("syarat");
Route::get("/kontak", [KontakController::class, "index"])->name("kontak");


Route::middleware('auth')->group(function(){
    Route::get("/rental/{id}", [KeranjangController::class, "index"])->name("keranjang");
    Route::get("/riwayat/{id}", [RiwayatController::class, "index"])->name("riwayat");
    Route::get("/checkout/{id_transaction}", [PesanController::class, "index"])->name("checkout");
    Route::get("/payment/{id_transaction}", [PesanController::class, "payment"])->name("payment");

    Route::get("produk-kami/detail/{id}", [ProdukController::class, "detail"])->name("detail.produk");
    Route::get("produk-kami/search", [SearchController::class, "search"])->name("search");
    Route::get("produk-kami/{id_category}", [SearchController::class, "category"])->name("category.produk");
    Route::get("/myprofile", [ProfileController::class, "index"])->name("myprofile");

    Route::post("rental/posts", [KeranjangController::class, "posts"])->name("keranjang.posts");
    Route::post("/myprofile/post", [ProfileController::class, "posts"])->name("myprofile.posts");
    Route::post("/checkout/post", [PesanController::class, "posts"])->name("checkout.posts");
    Route::post("/payment/post", [PesanController::class, "transfer"])->name("payment.posts");

    Route::get('rental/delete/{id}', [KeranjangController::class, 'delete'])->name('delete.keranjang');
    Route::get('riwayat/delete/{id}', [PesanController::class, 'delete'])->name('batal.transaksi');
});

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Hompage\IndexController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RoleController;
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
});



//Logout
Route::post("logout/post", [LogoutController::class, "posts"])->name('posts.logout');


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



// Pelanggan
Route::get("/", [IndexController::class, "index"])->name("home");


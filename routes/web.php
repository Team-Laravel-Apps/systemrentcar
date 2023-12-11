<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
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
    Route::get("/", [LoginController::class, "index"])->name("login");
    Route::post("login/post", [LoginController::class, "posts"])->name('posts.login');
});

Route::middleware('auth')->group(function(){
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
    Route::get("/role-users", [RoleController::class, "index"])->name("role");

    Route::get("/usersmanager", [UsersController::class, "index"])->name("users");
    Route::get("/usersmanager/add", [UsersController::class, "create"])->name("add.users");
    Route::get("/usersmanager/up/{id}", [UsersController::class, "update"])->name("up.users");


    Route::get("/kategori", [CategoriesController::class, "index"])->name("kategori");
    Route::get("/kategori/add", [CategoriesController::class, "create"])->name("add.kategori");
    Route::get("/kategori/up/{id_category}", [CategoriesController::class, "update"])->name("up.kategori");
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

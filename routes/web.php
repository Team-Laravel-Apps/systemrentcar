<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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
});



//Logout
Route::post("logout/post", [LogoutController::class, "posts"])->name('posts.logout');


//CRUD Master Role
Route::post("role/post", [RoleController::class, "posts"])->name('posts.role');
Route::post("role/update", [RoleController::class, "update"])->name('update.role');
Route::get('role/delete/{id_role}', [RoleController::class, 'delete'])->name('delete.role');




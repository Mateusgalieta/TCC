<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;

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


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile');
Route::post('/profile/update', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

//Users Routes
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('user.index');
Route::get('/users/register', [App\Http\Controllers\UsersController::class, 'register'])->name('user.register');
Route::post('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->name('user.create');
Route::get('/users/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');
Route::put('/users/{id}/update', [App\Http\Controllers\UsersController::class, 'update'])->name('user.update');
Route::get('/users/{id}/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->name('user.destroy');

//Categories Routes
Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('category.index');
Route::get('/categories/register', [App\Http\Controllers\CategoriesController::class, 'register'])->name('category.register');
Route::post('/categories/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('category.create');
Route::get('/categories/{id}/edit', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('category.edit');
Route::put('/categories/{id}/update', [App\Http\Controllers\CategoriesController::class, 'update'])->name('category.update');
Route::get('/categories/{id}/delete', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('category.destroy');

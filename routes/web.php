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

//Laravel UI package Routes
Auth::routes();

Route::middleware('auth')->group(function () {

    //Auth Users Routes
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

    //Departments Routes
    Route::get('/departments', [App\Http\Controllers\DepartmentsController::class, 'index'])->name('department.index');
    Route::get('/departments/register', [App\Http\Controllers\DepartmentsController::class, 'register'])->name('department.register');
    Route::post('/departments/create', [App\Http\Controllers\DepartmentsController::class, 'create'])->name('department.create');
    Route::get('/departments/{id}/edit', [App\Http\Controllers\DepartmentsController::class, 'edit'])->name('department.edit');
    Route::put('/departments/{id}/update', [App\Http\Controllers\DepartmentsController::class, 'update'])->name('department.update');
    Route::get('/departments/{id}/delete', [App\Http\Controllers\DepartmentsController::class, 'destroy'])->name('department.destroy');

    //Organizations Routes
    Route::get('/organizations', [App\Http\Controllers\OrganizationsController::class, 'index'])->name('organization.index');
    Route::get('/organizations/register', [App\Http\Controllers\OrganizationsController::class, 'register'])->name('organization.register');
    Route::post('/organizations/create', [App\Http\Controllers\OrganizationsController::class, 'create'])->name('organization.create');
    Route::get('/organizations/{id}/edit', [App\Http\Controllers\OrganizationsController::class, 'edit'])->name('organization.edit');
    Route::put('/organizations/{id}/update', [App\Http\Controllers\OrganizationsController::class, 'update'])->name('organization.update');
    Route::get('/organizations/{id}/delete', [App\Http\Controllers\OrganizationsController::class, 'destroy'])->name('organization.destroy');

    //Addresses Routes
    Route::get('/addresses', [App\Http\Controllers\AddressesController::class, 'index'])->name('address.index');
    Route::get('/addresses/register/{id}', [App\Http\Controllers\AddressesController::class, 'register'])->name('address.register');
    Route::post('/addresses/create', [App\Http\Controllers\AddressesController::class, 'create'])->name('address.create');
    Route::get('/addresses/{id}/edit', [App\Http\Controllers\AddressesController::class, 'edit'])->name('address.edit');
    Route::put('/addresses/{id}/update', [App\Http\Controllers\AddressesController::class, 'update'])->name('address.update');
    Route::get('/addresses/{id}/delete', [App\Http\Controllers\AddressesController::class, 'destroy'])->name('address.destroy');

    //Animals Routes
    Route::get('/animals', [App\Http\Controllers\AnimalsController::class, 'index'])->name('animal.index');
    Route::get('/animals/register', [App\Http\Controllers\AnimalsController::class, 'register'])->name('animal.register');
    Route::post('/animals/create', [App\Http\Controllers\AnimalsController::class, 'create'])->name('animal.create');
    Route::get('/animals/{id}/edit', [App\Http\Controllers\AnimalsController::class, 'edit'])->name('animal.edit');
    Route::put('/animals/{id}/update', [App\Http\Controllers\AnimalsController::class, 'update'])->name('animal.update');
    Route::get('/animals/{id}/delete', [App\Http\Controllers\AnimalsController::class, 'destroy'])->name('animal.destroy');

    //Rescue Routes
    Route::get('/rescue', [App\Http\Controllers\RescuesController::class, 'index'])->name('rescue.intern.list');
    Route::get('/rescue/register', [App\Http\Controllers\RescuesController::class, 'register'])->name('rescue.intern.register');
    Route::post('/rescue/create', [App\Http\Controllers\RescuesController::class, 'create'])->name('rescue.intern.create');
    Route::get('/rescue/{id}/edit', [App\Http\Controllers\RescuesController::class, 'edit'])->name('rescue.intern.edit');
    Route::put('/rescue/{id}/update', [App\Http\Controllers\RescuesController::class, 'update'])->name('rescue.intern.update');
    Route::get('/rescue/{id}/delete', [App\Http\Controllers\RescuesController::class, 'destroy'])->name('rescue.intern.destroy');

});

Route::get('/rescue/site', [App\Http\Controllers\Site\RescueController::class, 'index'])->name('site.rescue.index');
Route::post('/rescue/site/create', [App\Http\Controllers\Site\RescueController::class, 'create'])->name('site.rescue.create');



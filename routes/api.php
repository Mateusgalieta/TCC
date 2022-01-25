<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Users Routes
Route::name('user.')->group(function () {
    Route::get('/users', ['as' => 'allUsers', 'uses' => 'API\UsersController@allUsers']);
    Route::get('/users/{id}', ['as' => 'getUser', 'uses' => 'API\UsersController@getUser']);
    Route::post('/users/create', ['as' => 'create', 'uses' => 'API\UsersController@create']);
    Route::put('/users/{id}/update', ['as' => 'update', 'uses' => 'API\UsersController@update']);
    Route::delete('/users/{id}/delete', ['as' => 'destroy', 'uses' => 'API\UsersController@destroy']);
});

//Categories Routes
Route::name('category.')->group(function () {
    Route::get('/categories/{id}', ['as' => 'getCategories', 'uses' => 'API\CategoriesController@getCategories']);
    Route::post('/categories/create', ['as' => 'create', 'uses' => 'API\CategoriesController@create']);
    Route::put('/categories/{id}/update', ['as' => 'update', 'uses' => 'API\CategoriesController@update']);
    Route::delete('/categories/{id}/delete', ['as' => 'destroy', 'uses' => 'API\CategoriesController@destroy']);
});

//Rescues Routes
Route::name('rescue.')->group(function () {
    Route::get('/rescues/{id}', ['as' => 'getRescues', 'uses' => 'API\RescuesController@getRescues']);
    Route::post('/rescues/create', ['as' => 'create', 'uses' => 'API\RescuesController@create']);
    Route::put('/rescues/{id}/update', ['as' => 'update', 'uses' => 'API\RescuesController@update']);
    Route::delete('/rescues/{id}/delete', ['as' => 'destroy', 'uses' => 'API\RescuesController@destroy']);
});

//Departments Routes
Route::name('department.')->group(function () {
    Route::get('/departments/{id}', ['as' => 'getDepartments', 'uses' => 'API\DepartmentsController@getDepartments']);
    Route::post('/departments/create', ['as' => 'create', 'uses' => 'API\DepartmentsController@create']);
    Route::put('/departments/{id}/update', ['as' => 'update', 'uses' => 'API\DepartmentsController@update']);
    Route::delete('/departments/{id}/delete', ['as' => 'destroy', 'uses' => 'API\DepartmentsController@destroy']);
});

//Animals Routes
Route::name('animal.')->group(function () {
    Route::get('/animals/{id}', ['as' => 'getAnimals', 'uses' => 'API\AnimalsController@getAnimals']);
    Route::post('/animals/create', ['as' => 'create', 'uses' => 'API\AnimalsController@create']);
    Route::put('/animals/{id}/update', ['as' => 'update', 'uses' => 'API\AnimalsController@update']);
    Route::delete('/animals/{id}/delete', ['as' => 'destroy', 'uses' => 'API\AnimalsController@destroy']);
});

//Address Rescue Routes
Route::name('address.')->group(function () {
    Route::get('/animals/{id}/addressRescue', ['as' => 'getAddress', 'uses' => 'API\AnimalsController@getAddress']);
    Route::post('/animals/addressRescue/create', ['as' => 'addressRescue', 'uses' => 'API\AnimalsController@createAddress']);
    Route::put('/animals/{id}/addressRescue/update', ['as' => 'updateAddress', 'uses' => 'API\AnimalsController@updateAddress']);
});

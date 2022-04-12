<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('public.home');
});

Auth::routes();

Route::middleware("auth")
  ->namespace("Admin")
  ->prefix("admin")
  ->name("admin.")
  ->group(function () {
    // GROUP LOGGED ROUTE

    Route::resource('apartments', 'ApartmentController');  
});

Route::get('/home', 'HomeController@index')->name('home');


// VUE CONNECTION WEB.php:

// Route::get("{any?}", function () {
//     return view("public.home");
//   })->where("any", ".*");


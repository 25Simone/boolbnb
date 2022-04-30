<?php

use App\Http\Controllers\Admin\InboxController;
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
Auth::routes();

Route::middleware("auth")
  ->namespace("Admin")
  ->prefix("admin")
  ->name("admin.")
  ->group(function () {
    // GROUP LOGGED ROUTE
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('apartments', 'ApartmentController');  
    Route::get('/inbox','InboxController@index')->name('inbox');
    Route::delete('/inbox/{inbox}','InboxController@destroy')->name('inbox.destroy');
});

// VUE CONNECTION WEB.php:

Route::get("{any?}", function () {
  return view("vueHome");
})->where("any", ".*");


<?php

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
    return view('welcome');
});

//rotte di autenticazione
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('login','App\Http\Controllers\Auth\LoginController@login');
/*Route::get('logout', 'App\Http\Controllers\Auth\LoginController@getLogout');*/




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    'middleware' => ['auth', 'type:Ricercatore,Manager,Finanziatore'],
], function(){
    //rotte che solo Ricercatori Manager e finanziatori possono vedere
});

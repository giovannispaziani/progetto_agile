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

Route::get('/ricercatore', [App\Http\Controllers\dashboardRicercatoreController::class, 'index'])->name('dashboardRicercatore');

Route::group([
    'middleware' => ['auth', 'type:Ricercatore,Manager,Finanziatore'],
], function(){
    //rotte che solo Ricercatori Manager e finanziatori possono vedere
});
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::get('table-list', function () {
		return view('table_list');
	})->name('table');

	Route::get('pubblicazioniRicercatore', 'App\Http\Controllers\AddPublicationController@index'
	})->name('pubblicazioniRicercatore');
    Route::post('pubbli')

	Route::get('budgetRicercatore', function () {
		return view('ricercatore.budgetRicercatore');
	})->name('budgetRicercatore');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::get('profileRicercatore', ['as' => 'ricercatore.editRicercatore', 'uses' => 'App\Http\Controllers\ProfileResearcherController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});




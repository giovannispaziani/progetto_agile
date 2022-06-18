<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\creazioneProgettoController;

use App\Http\Controllers\projectDashboardController;
use App\Http\Controllers\projectListController;
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

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('/registerFin','App\Http\Controllers\RegisterFinController@index')->name('registerFin');
Route::post('/registerFin','App\Http\Controllers\RegisterFinController@create')->name('registerFin-post');

Route::group(['middleware' => 'auth'], function () {

	Route::get('table-list', function () {
		return view('table_list');
	})->name('table');

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
	Route::get('profileManager', ['as' => 'manager.editManager', 'uses' => 'App\Http\Controllers\ProfileResearcherController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
});


/* conferma email */
Route::get('/email/verify', function(){
	return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}',function (EmailVerificationRequest $request){
	$request->fulfill();

	return redirect('/home');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request){
	$request->user()->sendEmailVerificationNotification();

	return back()->with('message','Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');


/* Creazione progetto  */
Route::get('/create-project', 'App\Http\Controllers\creazioneProgettoController@index')->name('project-create');
Route::post('/create-project', 'App\Http\Controllers\creazioneProgettoController@create')->name('project-create-post');

/* Dashboard Progetto */
Route::get('/project-dashboard/{id}',[projectDashboardController::class,'index'])->name('project-dashboard')->middleware();

/* Lista Progetti */
Route::get('/project-list',[projectListController::class,'index'])->name('project-list')->middleware();
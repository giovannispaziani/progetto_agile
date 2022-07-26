<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\modificaPartecipantiProgettoController;
use App\Http\Controllers\projectDashboardController;
use App\Http\Controllers\projectListController;
use App\Http\Controllers\documentationController;
use App\Http\Controllers\dashboardAcquistiController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PubblicazioniController;
use App\Http\Controllers\PubblicazioniScientificheController;
use App\Http\Controllers\UsersListController;

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

/* Pubblicazione scientifica ricercatore */
Route::get('/pubblicazioniScientifiche', 'App\Http\Controllers\PubblicazioniScientificheController@index')->name('pubblicazioniScientifiche');
Route::post('/pubblicazioniScientifiche','App\Http\Controllers\PubblicazioniScientificheController@aggiungiPubblicazioneScientifica')->name('pubblicazioniScientifiche-post');
Route::get('/eliminaPubblicazioneScientifica/{id}',[PubblicazioniScientificheController::class,'eliminaPubblicazione']);
Route::post('/modificaPubblicazioneScientifica','App\Http\Controllers\PubblicazioniScientificheController@modificaPubblicazione')->name('modificaPubblicazioneScientifica');

/* Budget Ricercatore */
Route::get('/budgetRicercatore', 'App\Http\Controllers\BudgetRicercatoreController@index')->name('budgetRicercatore')->middleware();

/* Lista Progetti */
Route::get('/project-list',[projectListController::class,'index'])->name('project-list')->middleware();

/*Profilo Ricercatore */
Route::get('/users/{id_ricercatore}', 'App\Http\Controllers\ProfiloRicercatoreController@index')->name('profilo-Ricercatore');

/*Profilo Manager*/
Route::get('/manager/{id_manager}', 'App\Http\Controllers\ProfiloManagerController@index')->name('profilo-Manager');

/* Dashboard Progetti Ricercatore */
Route::get('/dashboardProgettiRicercatore', 'App\Http\Controllers\DashboardProgettiRicercatoreController@index')->name('dashboardProgettiRicercatore')->middleware();

/* modifica partecipanti */
Route::get('/project-dashboard/{id_progetto}/add-ricercatore/{id_ricercatore}',[modificaPartecipantiProgettoController::class,'add'])->name('add-ricercatore');
Route::get('/lista-ricercatore/{id_progetto}',[modificaPartecipantiProgettoController::class,'index'])->name('list-ricercatori');
Route::get('/project-dashboard/{id}/remove/{ricercatore}',[modificaPartecipantiProgettoController::class,'remove'])->name('remove-ricercatore');

/* gestione documentazione */
Route::get('/project-dashboard/document-list/{id}',[documentationController::class, 'index'])->name('document-list')->middleware('auth');;

/* Aggiorna dati progetto */
Route::post('/cambio-data-fine-progetto', [projectDashboardController::class,'updateFine'])->name('update-project-date');
Route::post('/elimina-progetto', [projectDashboardController::class,'deleteProject'])->name('elimina-progetto');
Route::post('/modifica-progetto', [projectDashboardController::class,'updateProject'])->name('modifica-progetto');
Route::post('/elimina-pubblicazione', [projectDashboardController::class,'deletePublicationFromProject'])->name('elimina-pubblicazione-da-progetto');

/*gestione richieste budget */
Route::get('/project-list-responsabile',[dashboardAcquistiController::class,'getListProject'])->name('progect-list-responsabile');
Route::get('/dashboard-budget/{id}',[dashboardAcquistiController::class,'index'])->name('dashboard-budget');
Route::get('/storico-budget/{id}',[dashboardAcquistiController::class, 'storico'])->name('storico-budget');
Route::post('/accept-budget',[dashboardAcquistiController::class,'acceptBudget'])->name('accept-budget');
Route::post('/refuse-budget',[dashboardAcquistiController::class,'refuseBudget'])->name('refuse-budget');
Route::post('/aggiungi-budget',[dashboardAcquistiController::class,'aggiungiBudget'])->name('aggiungi-budget');

/* Pubblicazione ricercatore */
Route::get('/aggiungiPubblicazione', 'App\Http\Controllers\PubblicazioniController@index')->name('aggiungiPubblicazione');
Route::post('/aggiungiPubblicazione','App\Http\Controllers\PubblicazioniController@aggiungiPubblicazione')->name('aggiungiPubblicazione-post');
Route::get('/eliminaPubblicazione/{id}',[PubblicazioniController::class,'eliminaPubblicazione']);
Route::post('/modificaPubblicazione','App\Http\Controllers\PubblicazioniController@modificaPubblicazione')->name('modificaPubblicazione');

/* Download file pubblicazione */
Route::get('/scarica{fileName}', 'App\Http\Controllers\ProfiloRicercatoreController@download')->name('pubblicazionefile.scarica');

/* Aggiungi voce ricercatore */
Route::get('/aggiungiVoce', 'App\Http\Controllers\AggiungiVoceController@index')->name('aggiungiVoce');
Route::post('/aggiungiVoce','App\Http\Controllers\AggiungiVoceController@aggiungiVoce')->name('aggiungiVoce-post');


Route::get('file-upload', [ FileUploadController::class, 'getFileUploadForm' ])->name('get.fileupload');
Route::post('file-upload', [ FileUploadController::class, 'store' ])->name('store.file');

/*Dashboard Finanziatore*/
Route::get('/dashboardFinanziatore', 'App\Http\Controllers\DashboardFinanziatoreController@index')->name('dashboardFinanziatore')->middleware();

/*Budget Finanziatore*/
Route::get('/budgetFinanziatore/{id_progetto}','App\Http\Controllers\BudgetFinanziatoreController@index')->name('budgetFinanziatore')->middleware();

/* Creazione sottoprogetto  */
Route::get('/aggiungiSottoprogetto/{id_progetto}', 'App\Http\Controllers\SottoProgettoController@index')->name('aggiungiSottoprogetto');
Route::post('/aggiungiSottoprogetto', 'App\Http\Controllers\SottoProgettoController@create')->name('aggiungiSottoprogetto-post');

/* Lista sottoprogetti */
Route::get('/sottoProgettiList/{id_progetto}', 'App\Http\Controllers\ListaSottoProgettiController@index')->name('sottoProgetti-List')->middleware();

/* Creazione milestone  */
Route::get('/aggiungiMilestone/{id_sottoprogetto}', 'App\Http\Controllers\MilestoneController@index')->name('aggiungiMilestone');
Route::post('/aggiungiMilestone', 'App\Http\Controllers\MilestoneController@create')->name('aggiungiMilestone-post');

/* Lista milestone */
Route::get('/milestoneList/{id_sottoprogetto}', 'App\Http\Controllers\ListaMilestoneController@index')->name('milestone-List')->middleware();

/* Stato Avanzamento Lavori */
Route::get('/statoAvanzamentoLavori/{id_progetto}', 'App\Http\Controllers\StatoAvanzamentoLavoriController@index')->name('statoAvanzamentoLavori')->middleware();

/* Lista Progetti */
Route::get('/users-list',[UsersListController::class,'index'])->name('users-list')->middleware();

/* Report Progetti */
Route::get('/reportList/{id_progetto}','App\Http\Controllers\ReportProgettoController@index')->name('reportList')->middleware();
Route::get('/aggiungiReport','App\Http\Controllers\ReportProgettoController@aggiuntaReport')->name('aggiungiReport');
Route::post('/aggiungiReport','App\Http\Controllers\ReportProgettoController@caricaReport')->name('aggiungiReport-post');

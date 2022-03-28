<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\test;
use App\Http\Controllers\connexion;
use App\Http\Controllers\admin;
use App\Http\Controllers\user;

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

Route::get('test', [user::class, 'test']);

Route::get('/', [connexion::class, 'verification']);

Route::post('/connexion', [connexion::class, 'connexion']);

Route::get('Inscription', function () {
    return view('pageinscription');
});

Route::get('inscriptionexe', [connexion::class, 'inscriptionexe']);

Route::get('mdpoublie', function () {
    return view('mdpoublie');
});

Route::get('oublie', [connexion::class, 'reinitialisemdp']);

Route::get('testAdmin', [admin::class, 'test']);

Route::get('modificationFileAttente/updateFileAttente/{idReservation}', [admin::class, 'listeattente']);

Route::get('demandesinscriptions', [admin::class, 'demandesinscriptions']);


Route::post('ListeAttente', [admin::class, 'listeattente']);

Route::post('ListeUtilisateur', [admin::class, 'listeutilisateur']);

Route::post('ListePlace', [admin::class, 'listeplace']);

Route::post('AjoutPlace', [admin::class, 'ajoutplace']);

Route::post('DeletePlace', [admin::class, 'deleteplace']);

Route::post('ListeReservation', [admin::class, 'listereservation']);

Route::post('AnnuleReservation', [admin::class, 'annulereservation']);

Route::post('HistoAttributionPlace', [admin::class, 'histoattributionplace']);

Route::post('modificationFileAttente/updateFileAttente/{idReservation}', [admin::class, 'updateFileAttente']);

Route::get('modificationFileAttente/{idReservation}', [admin::class, 'show']);

Route::get('toutaccepter', [admin::class, 'accepterToutesLesInscriptions']);

Route::get('toutrefuser', [admin::class, 'refuserToutesLesInscriptions']);

Route::get('accepterInscription/{idUtilisateur}', [admin::class, 'accepterInscription']);

Route::get('refuserInscription/{idUtilisateur}', [admin::class, 'refuserInscription']);

Route::get('testuser', function () {
    return view('user.testuser');
});

Route::post('VosReservation', [user::class, 'reservation']);
Route::post('ReservationExe', [user::class, 'ReservationExe']);
Route::post('annuler', [user::class, 'annule']);
Route::post('ModificationMDP', [user::class, 'formMDP']);
Route::post('ModificationConfirmation', [user::class, 'confirmMDP']);

Route::get('testinscription', function () {
    return view('testinscriptionform');
});

Route::post('testinscriptionresultat', [test::class, 'testinscription']);

Route::get('/modificationMdpUtilisateur/{idUtilisateur}', [admin::class, 'showModifMdp']);

Route::post('/updateMotDePasse', [admin::class, 'updateMotDePasse']);

Route::get('/testmail', [connexion::class, 'testmail']);

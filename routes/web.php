<?php

use App\Http\Livewire\Admins;
use App\Http\Livewire\Clients;
use App\Http\Livewire\Commercial;
use App\Http\Livewire\Company;
use App\Http\Livewire\Comptable;
use App\Http\Livewire\DataStatic;
use App\Http\Livewire\Employes;
use App\Http\Livewire\Fournisseurs;
use App\Http\Livewire\General;
use App\Http\Livewire\History;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Users;
use App\Http\Livewire\Profil;
use App\Http\Livewire\Password;
use App\Http\Livewire\Produits;
use App\Http\Livewire\Prospects;
use App\Http\Livewire\Reunions;
use App\Http\Livewire\Taches;
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

Route::get('/', Login::class)->name('login');
Route::get('/accueil', Home::class)->name('home');
Route::get('/utilisateurs', Users::class)->name('users');
Route::get('/donnees_statiques', DataStatic::class)->name('staticData');
Route::get('/entreprises', Company::class)->name('entreprises');
Route::get('/employes', Employes::class)->name('employe');
Route::get('/produits', Produits::class)->name('produit');
Route::get('/clients', Clients::class)->name('client');
Route::get('/fournisseurs', Fournisseurs::class)->name('fournisseur');
Route::get('/prospects', Prospects::class)->name('prospect');
Route::get('/taches', Taches::class)->name('tache');
Route::get('/reunions', Reunions::class)->name('reunion');
Route::get('/commerciaux', Commercial::class)->name('commercial');
Route::get('/comptables', Comptable::class)->name('comptable');
Route::get('/administrateurs', Admins::class)->name('admin');
Route::get('/historiques', History::class)->name('history');
Route::get('/profil', Profil::class)->name('profil');
Route::get('/mot_de_passe', Password::class)->name('password');
Route::get('/configuration_generale', General::class)->name('general');

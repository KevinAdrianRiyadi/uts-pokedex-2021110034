<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });


Route::post('create-pokemon', [PokemonController::class, 'store'])->name('create-pokemon')->middleware('auth');
Route::get('create-pokemon', [PokemonController::class, 'create'])->name('createview-pokemon');
Route::get('/pokemon/{id}', [PokemonController::class, 'edit'])->name('edit')->middleware('auth');
Route::get('/showpokemon', [PokemonController::class, 'show'])->name('show');
Route::post('/destroypokemon/{id}', [PokemonController::class, 'destroy'])->name('destroy');
Route::get('/index', [PokemonController::class, 'index'])->name('index');
Route::put('/update-pokemon/{id}', [PokemonController::class, 'update'])->name('update')->middleware('auth');
Route::resource('pokemon',PokemonController::class);

Route::get('/login', [PokemonController::class,'login'])->name('login');
Route::get('/register', [PokemonController::class,'register'])->name('register');
Route::post('/register', [PokemonController::class,'storeregister'])->name('register');
Route::post('/login', [PokemonController::class,'postlogin'])->name('postlogin');
Route::post('/logout', [PokemonController::class, 'logout'])->name('logout');

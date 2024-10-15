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


Route::post('create-pokemon', [PokemonController::class, 'store'])->name('create-pokemon');
Route::get('create-pokemon', [PokemonController::class, 'create'])->name('createview-pokemon');
Route::get('/', [PokemonController::class, 'index'])->name('index');
Route::resource('pokemon',PokemonController::class);

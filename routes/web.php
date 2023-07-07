<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard', ['user' => Auth::user()]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/comunicar_falta', function () {
    return view('comunicar_falta', ['user' => Auth::user()]);
})->middleware(['auth', 'verified'])->name('comunicar_falta');



Route::get('/cadastro', [CadastroController::class, 'create']
)->middleware(['auth', 'verified'])->name('cadastro');
Route::post('/cadastro', [CadastroController::class, 'store']
)->middleware(['auth', 'verified'])->name('store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/** Spotify */
Route::get('/spotify/login', [SpotifyController::class, 'login']);
Route::get('/spotify/callback', [SpotifyController::class, 'callback']);
Route::get('/spotify/token', [SpotifyController::class, 'token']);

Route::get('/spotify/play/{device_id}', [SpotifyController::class, 'play']);
Route::get('/spotify/transfer/{device_id}', [SpotifyController::class, 'transfer']);


Route::get('/playlist', function() {
    return view('cadastro_participante.playlist-react');
});
Route::get('/spotify/buscar/{search}', [SpotifyController::class, 'buscar']);

Route::post('/playlist', [SpotifyController::class, 'playlist']);
//Route::get('/playlist/salvar', [SpotifyController::class, 'playlist']);





Route::get('/questionario_previo', function () {
    return view('oficina.questionario-antes');
})->middleware(['auth', 'verified'])->name('oficina');

Route::get('/questionario_final', function () {
    return view('oficina.questionario-depois');
})->middleware(['auth', 'verified'])->name('questionario_fim');

Route::post('/questionario_previo', [OficinaController::class, 'store_previo']
)->middleware(['auth', 'verified'])->name('questionario_previo');

Route::post('/questionario_final', [OficinaController::class, 'store_final']
)->middleware(['auth', 'verified'])->name('questionario_final');



/**Rotas Provisórias para Teste */
Route::get('/store', [CadastroController::class, 'store']
)->middleware(['auth', 'verified'])->name('store');
Route::get('/gerar', [CadastroController::class, 'gerar']
)->middleware(['auth', 'verified'])->name('gerar');
Route::get('/teste', function () {
    return view('testes-de-layout');
});
Route::get('/playlist', function () {
    return view('cadastro_participante.playlist');
});
Route::get('/player', function () {
    return view('player');
});


require __DIR__.'/auth.php';

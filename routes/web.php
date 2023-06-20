<?php

use App\Http\Controllers\CadastroParticipanteController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Http\Request;
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

Route::post('count', function (Request $request) {
    return response()->json([
        'message' => $request->message,
    ]);
});

Route::get('/spotify/login', [SpotifyController::class, 'login']);
Route::get('/spotify/callback', [SpotifyController::class, 'callback']);
Route::get('/spotify/token', [SpotifyController::class, 'token']);

Route::get('/spotify/play/{device_id}', [SpotifyController::class, 'play']);


Route::get('/playlist', function() {
    return view('cadastro_participante.playlist');
});
Route::post('/playlist/buscar', [SpotifyController::class, 'buscar']);
Route::post('/playlist/criar', [SpotifyController::class, 'criar']);
Route::post('/playlist/salvar', [SpotifyController::class, 'salvar']);



Route::get('/cadastrar_participante/{projeto}/{grupo}', [CadastroParticipanteController::class, 'iniciar']);   
Route::post('/cadastrar_participante', [CadastroParticipanteController::class, 'cadastrar']);  
Route::get('/cadastrar_participante', [CadastroParticipanteController::class, 'cadastrar']);   


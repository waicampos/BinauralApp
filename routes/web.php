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
    return view('hello');
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
Route::get('/spotify/transfer/{device_id}', [SpotifyController::class, 'transfer']);


Route::get('/playlist', function() {
    return view('cadastro_participante.playlist-react');
});
Route::get('/spotify/buscar/{search}', [SpotifyController::class, 'buscar']);

Route::post('/playlist', [SpotifyController::class, 'playlist']);
//Route::get('/playlist/salvar', [SpotifyController::class, 'playlist']);



Route::get('/cadastrar_participante/{projeto}/{grupo}', [CadastroParticipanteController::class, 'iniciar']);   
Route::post('/cadastrar_participante', [CadastroParticipanteController::class, 'cadastrar']);  
Route::post('/cadastrar_participante/finalizar', [CadastroParticipanteController::class, 'finalizar']);   


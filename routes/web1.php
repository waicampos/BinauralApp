<?php

use App\Http\Controllers\CadastroParticipanteController;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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


// Grupo de rotas de cadastro de participante


Route::get('/teste', [TesteController::class, 'testar']);


Route::get('/spotify/login', [SpotifyController::class, 'login']);
Route::get('/spotify/callback', [SpotifyController::class, 'callback']);
Route::get('/spotify/token', [SpotifyController::class, 'token']);
Route::get('/spotify/api-me', [SpotifyController::class, 'me']);

    
Route::get('/cadastrar_participante/{projeto}/{grupo}', [CadastroParticipanteController::class, 'iniciar']);   
Route::post('/cadastrar_participante', [CadastroParticipanteController::class, 'cadastrar']);  
Route::get('/cadastrar_participante', [CadastroParticipanteController::class, 'cadastrar']);   



Route::get('/indicadores', function(Request $request) {return view('cadastro_participante.indicadores', ['request' => $request]);});
Route::post('/indicadores', [ParticipanteController::class, 'indicadores']);

Route::get('/aviso_termo', function() {return view('cadastro_participante.aviso_termo');});

Route::get('/termo_autorizacao', function() {return view('cadastro_participante.autorizacao');});
Route::post('/termo_autorizacao', [ParticipanteController::class, 'autorizacao']);

Route::get('/questionario_inicial', function() {return view('cadastro_participante.questionario');});
Route::post('/questionario_inicial', [ParticipanteController::class, 'questionario']);

Route::get('/finalizar_cadastro', function(){return view('cadastro_participante.finalizar');});
Route::post('/finalizar_cadastro', [ParticipanteController::class, 'finalizarCadastro']);






// Route::middleware('auth')->group(function() {
    
//     Route::get('/cadastrar_participante/{projeto}/{grupo}', [ParticipanteController::class, 'iniciarCadastro']);   

//     Route::get('/indicadores', function(Request $request) {return view('cadastro_participante.indicadores', ['request' => $request]);});
//     Route::post('/indicadores', [ParticipanteController::class, 'indicadores']);

//     Route::get('/aviso_termo', function() {return view('cadastro_participante.aviso_termo');});

//     Route::get('/termo_autorizacao', function() {return view('cadastro_participante.autorizacao');});
//     Route::post('/termo_autorizacao', [ParticipanteController::class, 'autorizacao']);

//     Route::get('/questionario_inicial', function() {return view('cadastro_participante.questionario');});
//     Route::post('/questionario_inicial', [ParticipanteController::class, 'questionario']);

//     Route::get('/finalizar_cadastro', function(){return view('cadastro_participante.finalizar');});
//     Route::post('/finalizar_cadastro', [ParticipanteController::class, 'finalizarCadastro']);


// });









// Rotas de teste para conferir passagem de dados!
Route::get('/projetos/{projeto_id}', [ProjetoController::class, 'verProjeto']);
Route::get('/projetos/grupos/{grupo_id}', [ProjetoController::class, 'verGrupo']);
Route::get('/projetos/participantes/{user_id}', [UserController::class, 'verGrupos']);


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

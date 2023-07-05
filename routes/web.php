<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ProfileController;
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

Route::get('/teste', function () {
    return view('auth.teste');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/cadastro', [CadastroController::class, 'create']
)->middleware(['auth', 'verified'])->name('cadastro');
Route::post('/cadastro', [CadastroController::class, 'store']
)->middleware(['auth', 'verified'])->name('store');

/**Rotas Provisórias para Teste */
Route::get('/store', [CadastroController::class, 'store']
)->middleware(['auth', 'verified'])->name('store');
Route::get('/gerar', [CadastroController::class, 'gerar']
)->middleware(['auth', 'verified'])->name('gerar');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

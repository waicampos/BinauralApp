<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

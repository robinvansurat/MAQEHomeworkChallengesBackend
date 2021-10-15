<?php

use App\Http\Controllers\MaqebotController;
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

Route::get('/', function () {
    return view('app');
});

Route::get('/app', function ($id) {
    return view('app');
});

Route::prefix('ajax')->group(function () {
    Route::post('/maqebot', [MaqebotController::class,"getCodex"]);
});

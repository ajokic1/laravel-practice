<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', [HomeController::class, 'index'])
    ->name('test.index')
    ->middleware('age');
Route::post('/test', [HomeController::class, 'store'])
    ->name('test.store');
Route::match(['put', 'patch'], '/test/{id}', [HomeController::class, 'update'])
    ->name('test.update');
Route::delete('/test/{id}', [HomeController::class, 'destroy'])
    ->name('test/delete');

Route::resource('/resource', ResourceController::class);

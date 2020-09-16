<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
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

Route::resource('/posts', PostController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('invalidate/{forever?}', [AuthController::class, 'invalidate']);
});

Route::get('/data/open', [DataController::class, 'open']);
Route::get('/data/closed', [DataController::class, 'closed'])->middleware('jwt');

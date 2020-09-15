<?php

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

Route::get('/test', function () {
    return "test";
})->middleware('age');

Route::post('/test', function (Request $request) {
    return $request->all();
});

Route::put('/test/{id}', function (Request $request, $id) {
    return "Updated id $id with data:" . json_encode($request->all());
});

Route::patch('/test/{id}', function (Request $request, $id) {
    return "Updated id $id with data:" . json_encode($request->all());
});

Route::delete('/test/{id}', function ($id) {
    return "Deleted $id";
});

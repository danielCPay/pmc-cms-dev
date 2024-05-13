<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/portfoliopurchases', [CheckController::class, 'index']);
Route::get('/portfoliopurchases/latest', [CheckController::class, 'getLatest']);
Route::get('/portfoliopurchases/{portfolio}', [CheckController::class, 'show']);
Route::post('/portfoliopurchases', [CheckController::class, 'store']);
Route::put('/portfoliopurchases/{portfolio}', [CheckController::class, 'update']);
Route::delete('/portfoliopurchases/{check}', [CheckController::class, 'destroy']);
Route::put('/portfoliopurchases/fill/fields', [CheckController::class, 'fillFields']);
Route::get('/portfoliopurchases/countrows/{filePath}', [CheckController::class, 'countRows']);
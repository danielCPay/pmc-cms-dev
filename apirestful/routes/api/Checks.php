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

Route::get('/checks', [CheckController::class, 'index']);
Route::get('/checks/latest', [CheckController::class, 'getLatest']);
Route::get('/checks/{checksid}', [CheckController::class, 'show']);
Route::post('/checks', [CheckController::class, 'store']);
Route::put('/checks/{checksid}', [CheckController::class, 'update']);
Route::delete('/checks/{check}', [CheckController::class, 'destroy']);
Route::put('/checks/fill/fields', [CheckController::class, 'fillFields']);
Route::get('/checks/countrows/{filePath}', [CheckController::class, 'countRows']);
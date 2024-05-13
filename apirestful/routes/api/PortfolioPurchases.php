<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioPurchasesController;

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

Route::get('/portfoliopurchases', [PortfolioPurchasesController::class, 'index']);
Route::get('/portfoliopurchases/latest', [PortfolioPurchasesController::class, 'getLatest']);
Route::get('/portfoliopurchases/{portfolio}', [PortfolioPurchasesController::class, 'show']);
Route::post('/portfoliopurchases', [PortfolioPurchasesController::class, 'store']);
Route::put('/portfoliopurchases/{portfolio}', [PortfolioPurchasesController::class, 'update']);
Route::delete('/portfoliopurchases/{check}', [PortfolioPurchasesController::class, 'destroy']);
Route::put('/portfoliopurchases/fill/fields', [PortfolioPurchasesController::class, 'fillFields']);
Route::get('/portfoliopurchases/countrows/{filePath}', [PortfolioPurchasesController::class, 'countRows']);
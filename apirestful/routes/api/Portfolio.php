<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

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

Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/portfolio/latest', [PortfolioController::class, 'getLatest']);
Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show']);
Route::post('/portfolio', [PortfolioController::class, 'store']);
Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update']);
Route::delete('/portfolio/{check}', [PortfolioController::class, 'destroy']);
Route::put('/portfolio/fill/fields', [PortfolioController::class, 'fillFields']);
Route::get('/portfolio/countrows/{filePath}', [PortfolioController::class, 'countRows']);
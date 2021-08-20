<?php

use App\Http\Controllers\Api\AuthorController;
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

Route::group(['prefix' => 'api/authors'], function () {
    Route::get('/', [AuthorController::class, 'index']);
    Route::get('{id}', [AuthorController::class, 'show']);
    Route::post('/', [AuthorController::class, 'create']);
    Route::put('{id}', [AuthorController::class, 'update']);
    Route::delete('{id}', [AuthorController::class, 'delete']);
});

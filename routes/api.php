<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::resource('task', TodoController::class); 

Route::get('task', [TodoController::class, 'index']);
Route::post('task', [TodoController::class, 'store']);
Route::get('task/{task}', [TodoController::class, 'show']);
Route::put('task/{task}', [TodoController::class, 'update']);
Route::delete('task/{task}', [TodoController::class, 'destroy']);
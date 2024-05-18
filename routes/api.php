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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/unauthenticated', function () {
    return response()->json(['message' => "Unauthenticated"], 401);
})->name('api.unauthenticated');
Route::get('/unauthorized', function () {
    return response()->json(['message' => "Unauthorized"], 403);
})->name('api.unauthorized');
Route::post('/create', [App\Http\Controllers\SchoolController::class, 'create']);

Route::group(['middleware' => ['auth:sanctum']], function () {

});
Route::middleware('auth:sanctum')->group(function () {
 
});

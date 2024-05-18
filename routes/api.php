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
    Route::get('/get-active-adverts', [App\Http\Controllers\AdvertController::class, 'activeAdvert']);
    Route::get('/get-advert-details',  [App\Http\Controllers\AdvertController::class, 'advertDetails']);
    Route::get('/get-archive-record',  [App\Http\Controllers\ArchiveController::class, 'getArchiveByRecord']);
    Route::get('/get-government-news',  [App\Http\Controllers\NewsController::class, 'getGovernmentNews']);
    Route::get('/get-mda-news',  [App\Http\Controllers\NewsController::class, 'getMdaNews']);
    Route::get('/get-news',  [App\Http\Controllers\NewsController::class, 'getNews']);
});

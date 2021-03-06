<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestCodeController;
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


Route::get('/testcode/{countyName}', [TestCodeController::class, 'index']);




Route::group(['middleware' => 'cors'], function () {
    Route::get('/searchbycountry/{countyName}', [TestCodeController::class, 'searchByCountry']);
    Route::post('/freshuniversities', [TestCodeController::class, 'freshUniversities']);


    Route::get('/test', [TestCodeController::class, 'updateUniversitiesFromSource']);
});


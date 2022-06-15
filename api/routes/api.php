<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompanyCategoryController;
use App\Http\Controllers\API\LocationController;

use GuzzleHttp\Client;
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

Route::group(['prefix' => 'auth'], static function () {
    Route::post('login', [ AuthController::class, 'login']);
    Route::post('register', [ AuthController::class, 'register']);
    Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [ AuthController::class, 'user']);
        Route::post('update', [ AuthController::class, 'update']);
        Route::post('update-photo', [ AuthController::class, 'updatePhoto']);
        Route::post('change-password', [ AuthController::class, 'changePassword']);
        Route::get('location', [ AuthController::class, 'getUserLocation']);
        Route::post('location/update', [ AuthController::class, 'updateUserLocation']);
    });
    Route::post('logout', [ AuthController::class, 'logout'])->middleware('auth:sanctum');
});
Route::get('company-directions',[ CompanyCategoryController::class, 'index']);
Route::get('countries', [LocationController::class, 'countries']);
Route::get('regions/{country_id}', [LocationController::class, 'regions']);
Route::get('cities/{region_id}', [LocationController::class, 'cities']);
Route::get('/test', function (){
    $client = new Client([
        'base_uri'  =>  'http://auth_market',
    ]);
    try {
        $response = $client->request('GET', '/');

    } catch (Exception $exception) {
        dd($exception->getCode(),$exception->getMessage());
    }
    return $response->getBody()->getContents();
});

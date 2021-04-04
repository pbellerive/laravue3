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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', '\App\Users\LoginController@authenticate');
Route::post('register', '\App\Users\RegisterController@register');
Route::get('countries', 'App\Settings\SettingController@fetchCountries');
Route::get('states', 'App\Settings\SettingController@fetchStates');

Route::middleware('auth:sanctum')->group(function ($router) {
    Route::post('logout', '\App\Users\LoginController@logout');

    Route::apiResource('users', \App\Users\UserController::class, ['only' => ['update']]);
    Route::get('user', '\App\Users\UserController@getCurrentUser');
});
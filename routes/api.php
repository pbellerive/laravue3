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


Route::post('login', '\Laravue3\Stateless\Controllers\LoginController@authenticate');

Route::post('register', '\App\Users\RegisterController@register');
Route::get('countries', 'App\Settings\SettingController@fetchCountries');
Route::get('states', 'App\Settings\SettingController@fetchStates');

Route::middleware('stateless')->group(function ($router) {
    Route::get('check-auth', '\Laravue3\Stateless\Controllers\LoginController@checkLogin');

    Route::post('logout', '\Laravue3\Stateless\Controllers\LoginController@logout');

    Route::apiResource('permissions', \App\Permissions\PermissionController::class, ['only' => ['index']]);
    Route::apiResource('roles', \App\Roles\RoleController::class, ['only' => ['index']]);

    Route::delete('users/{user}/role/{role}', '\App\Users\UserController@removeRole');
    Route::post('users/{user}/role/{role}', '\App\Users\UserController@assignRole');

    Route::apiResource('users', \App\Users\UserController::class, ['only' => ['index', 'show', 'update']]);
    Route::get('user', '\App\Users\UserController@getCurrentUser');
});

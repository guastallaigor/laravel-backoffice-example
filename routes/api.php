<?php

use Illuminate\Http\Request;

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

// 'permissions'
Route::middleware([ 'api' ])->group(function () {
    Route::group([
            'prefix' => '/v1/backoffice/',
        ], function() {
        Route::post('login', 'Auth\AuthController@authenticate');

        Route::middleware([ 'jwt.auth' ])->group(function () {
            Route::apiResource('employee', 'EmployeeController');
            Route::post('employee/active/{employee}', 'EmployeeController@active');
            Route::post('employee/inactive/{employee}', 'EmployeeController@inactive');
        });
    });
});

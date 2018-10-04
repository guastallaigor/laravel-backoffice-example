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
Route::get('oi', function() {
    echo 'oi';
});
Route::middleware([ 'api' ])->group(function () {
    Route::group([
            'prefix' => '/v1/backoffice/',
        ], function() {
        Route::post('login', 'Domains\AuthController@authenticate');

        Route::middleware([ 'jwt.auth' ])->group(function () {
            Route::apiResource('employee', 'Domains\EmployeeController');
            Route::post('employee/active/{employee}', 'Domains\EmployeeController@active');
            Route::post('employee/inactive/{employee}', 'Domains\EmployeeController@inactive');
        });
    });
});

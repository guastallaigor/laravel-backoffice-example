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


// , 'jwt.auth', 'permissions'
Route::middleware(['api'])->group(function () {
    Route::apiResource('/v1/backoffice/employee', 'EmployeeController');
    Route::post('/v1/backoffice/employee/active/{employee}', 'EmployeeController@active');
    Route::post('/v1/backoffice/employee/inactive/{employee}', 'EmployeeController@inactive');
});

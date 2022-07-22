<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

//Public Routes

Route::get('employee', "EmployeeController@index");
Route::get('employee/{id}', "EmployeeController@show");
Route::post('register',"AuthController@regiser");
Route::post('login',"AuthController@login");



//Private Routes

Route::group(['middleware'=>["auth:sanctum"]],function(){

    Route::post('employee',"EmployeeController@store");
    Route::put('employee', "EmployeeController@update");
    Route::delete('employee', "EmployeeController@destroy");
    Route::post('logout',"AuthController@logout");


});



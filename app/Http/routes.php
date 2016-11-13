<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('excel/export', 'ExcelController@export');
Route::get('excel/import', 'ExcelController@import');

Route::get('contacts', 'ContactController@index');
Route::get('contacts/import', 'ContactController@import');

Route::post('contacts/update','ContactController@update');

Route::post('branch/store','BranchController@store');

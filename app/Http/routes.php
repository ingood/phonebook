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

Route::get('/', 'ContactController@index');

Route::get('excel/export', 'ExcelController@export');
Route::get('excel/import', 'ExcelController@import');

Route::get('contacts', 'ContactController@index');

Route::get('contacts/list/{id}', 'ContactController@get');
Route::get('contacts/json', 'ContactController@json');
Route::get('contacts/json/{id}', 'ContactController@jsonbyid');
Route::get('contacts/import', 'ContactController@import');

Route::post('contacts/update','ContactController@update');

Route::post('branch/store','BranchController@store');
Route::post('branch/update','BranchController@update');
Route::get('branch/remove/{id}','BranchController@destroy');
Route::get('branch/json/{id}','BranchController@json');



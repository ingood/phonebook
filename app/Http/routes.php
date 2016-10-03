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


Route::get('yunle', function ()
{
	return 'hello v12200';
});

Route::get('contacts', function ()
{
	return 'this is contacts';
});

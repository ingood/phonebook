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

Route::get('about me', function ()
{
	return 'hello';
});


Route::get('v122', function ()
{
	return 'hello v12200';
});

Route::get('v111', function ()
{
	return 'hello v111';
});
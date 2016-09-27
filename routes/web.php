<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/home', function () {
	$date = date('Y');
    return view('page.dashboard',compact('date'));
});
Route::get('/', function () {
	$date = date('Y');
    return view('page.login',compact('date'));
});

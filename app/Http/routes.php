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

//Route::get('/test',['uses'=>'CarPartController@test']);
Route::get('/make',['uses'=>'CarPartController@Make']);
Route::get('/model',['uses'=>'CarPartController@Model']);
Route::get('/series',['uses'=>'CarPartController@Series']);
Route::get('/badges',['uses'=>'CarPartController@Badges']);
Route::get('/results',['uses'=>'CarPartController@NumberPrice']);
Route::get('/search', ['uses'=>'CarPartController@Search']);
Route::get('/showPart', ['uses'=>'CarPartController@ShowPart']);

Route::get('/description',['uses'=>'DescriptionController@getDescription']);












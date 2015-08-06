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

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', function () {
    return redirect()->route('phonenumber');
});

Route::get('/home', function () {
    return redirect()->route('phonenumber');
});

Route::get('/phonenumber/create', ['middleware' => 'auth', 'uses' => 'PhoneNumberController@create']);

Route::post('/phonenumber/create', ['middleware' => 'auth', 'uses' => 'PhoneNumberController@store']);

Route::get('/phonenumber/edit/{id}', ['middleware' => 'auth', 'uses' => 'PhoneNumberController@edit']);

Route::post('/phonenumber/edit/{id}', ['middleware' => 'auth', 'uses' => 'PhoneNumberController@update']);

Route::post('/phonenumber/delete', ['middleware' => 'auth', 'uses' => 'PhoneNumberController@destroy']);

Route::get('/phonenumber/{page?}', ['as' => 'phonenumber', 'middleware' => 'auth', 'uses' => 'PhoneNumberController@index']);

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('test', array('as' => 'home', 'uses' => 'PagesController@test'));

Route::get('/', array('as' => 'home', 'uses' => 'PagesController@home'));

/* Register */
Route::get('register', array('as' => 'register_path', 'uses' => 'RegistrationController@create'));

Route::post('register', array('as' => 'register_path', 'uses' => 'RegistrationController@store'));

/* Sesiones */
Route::post('login', array('as' => 'login_path', 'uses' => 'SessionsController@store'));

Route::get('logout', array('as' => 'logout_path', 'uses' => 'SessionsController@destroy'));

/* Password reset */
Route::controller('password', 'RemindersController');



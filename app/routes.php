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

Route::get('test', ['as' => 'home', 'uses' => 'PagesController@test']);

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

/* Registro */
Route::get('registro', ['before' => 'guest', 'as' => 'register_path', 'uses' => 'RegistrationController@create']);
Route::post('registro', ['before' => 'guest', 'as' => 'register_path', 'uses' => 'RegistrationController@store']);
Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'RegistrationController@confirm']);

/* Entrar o registrarse con Facebook o Google + */
Route::get('login_facebook', ['before' => 'guest', 'as' => 'login_facebook_path', 'uses' => 'SocialNetworksController@loginWithFacebook']);
Route::get('login_google', ['before' => 'guest', 'as' => 'login_google_path', 'uses' => 'SocialNetworksController@loginWithGoogle']);

/* Terminos y condiciones*/
Route::get('terminos-y-condiciones', ['as' => 'terms_path', 'uses' => 'PagesController@terms']);

/* Sesiones */
Route::post('entrar', ['as' => 'login_path', 'uses' => 'SessionsController@store']);
Route::get('salir', ['as' => 'logout_path', 'uses' => 'SessionsController@destroy']);

/* Password reset */
Route::controller('password', 'RemindersController');

/* Mi perfil */
Route::get('perfil', ['before' => 'auth', 'as' => 'profile_path', 'uses' => 'UsersController@showProfile']);
Route::post('perfil', ['before' => 'auth', 'as' => 'update_profile_path', 'uses' => 'UsersController@updateProfile']);
Route::get('perfil/password', ['before' => 'auth', 'as' => 'password_path', 'uses' => 'UsersController@showPassword']);
Route::post('perfil/password', ['before' => 'auth', 'as' => 'update_password_path', 'uses' => 'UsersController@updatePassword']);

Route::get('mis-cursos', ['before' => 'auth', 'as' => 'my_courses_path', 'uses' => 'CoursesController@index']);

Route::group(array('prefix' => 'curso/{course_id}'), function ()
{
    Route::get('/', array('before'=>'auth|isEnrolled','as' => 'course_path', 'uses' => 'CoursesController@show'));
});




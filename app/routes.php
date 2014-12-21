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

/* Vincular cuenta con Facebook o Google + */
Route::get('vincular_con_facebook', ['before' => 'auth', 'as' => 'link_facebook_path', 'uses' => 'SocialNetworksController@linkWithFacebook']);
Route::get('vincular_con_google', ['before' => 'auth', 'as' => 'link_google_path', 'uses' => 'SocialNetworksController@linkWithGoogle']);

/* Desvincular cuenta con Facebook o Google + */
Route::get('desvincular_con_facebook', ['before' => 'auth', 'as' => 'unlink_facebook_path', 'uses' => 'SocialNetworksController@unlinkWithFacebook']);
Route::get('desvincular_con_google', ['before' => 'auth', 'as' => 'unlink_google_path', 'uses' => 'SocialNetworksController@unlinkWithGoogle']);

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
Route::post('perfil/avatar', ['before' => 'auth', 'as' => 'change_avatar_path', 'uses' => 'UsersController@changeAvatar']);
Route::get('perfil/password', ['before' => 'auth', 'as' => 'password_path', 'uses' => 'UsersController@showPassword']);
Route::post('perfil/password', ['before' => 'auth', 'as' => 'update_password_path', 'uses' => 'UsersController@updatePassword']);

Route::get('mis-cursos', ['before' => 'auth', 'as' => 'my_courses_path', 'uses' => 'CoursesController@index']);

Route::group(array('prefix' => 'curso/{course_id}'), function ()
{
    Route::get('/', array('before' => 'auth|isEnrolled', 'as' => 'course_path', 'uses' => 'CoursesController@show'));

    /* Calendario */
    Route::get('/calendario', array('before' => 'auth|isEnrolled', 'as' => 'calendar_path', 'uses' => 'CoursesController@calendar'));

    /* Muro */
    Route::get('/muro', array('before' => 'auth|isEnrolled', 'as' => 'wall_path', 'uses' => 'WallMessagesController@index'));
    Route::post('/muro', array('before' => 'auth|isEnrolled', 'as' => 'wall_save_message_path', 'uses' => 'WallMessagesController@storeMessage'));
    Route::post('/muro/{wall_message_id}/respuesta', array('before' => 'auth|isEnrolled', 'as' => 'wall_save_reply_path', 'uses' => 'WallMessagesController@storeReply'));
    Route::put('/muro/editar', array('before' => 'auth|isEnrolled', 'as' => 'wall_edit_message_path', 'uses' => 'WallMessagesController@update'));
    Route::delete('/muro/eliminar', array('before' => 'auth|isEnrolled', 'as' => 'wall_delete_message_path', 'uses' => 'WallMessagesController@destroy'));

    /* Foro */
    Route::get('/foro', array('before' => 'auth|isEnrolled', 'as' => 'forum_path', 'uses' => 'ForumController@index'));
    Route::get('/foro/{topic_id}', array('before' => 'auth|isEnrolled', 'as' => 'topic_path', 'uses' => 'ForumController@show'));
    Route::post('/foro/{topic_id}/respuesta', array('before' => 'auth|isEnrolled', 'as' => 'topic_save_reply_path', 'uses' => 'ForumController@storeReply'));
    Route::put('/foro/{topic_id}/editar', array('before' => 'auth|isEnrolled', 'as' => 'topic_edit_reply_path', 'uses' => 'ForumController@updateReply'));
    Route::delete('/foro/{topic_id}/eliminar', array('before' => 'auth|isEnrolled', 'as' => 'topic_delete_reply_path', 'uses' => 'ForumController@destroyReply'));
});




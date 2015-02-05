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
Route::get('matricular', ['as' => 'home', 'uses' => 'PagesController@enroll']);
Route::get('qwertylog/{userID}', ['as' => 'home', 'uses' => 'PagesController@log']);
Route::get('duelos', ['as' => 'home', 'uses' => 'PagesController@duels']);

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);


/* Registro */
/*
Route::get('registro', ['before' => 'guest', 'as' => 'register_path', 'uses' => 'RegistrationController@create']);
Route::post('registro', ['before' => 'guest', 'as' => 'register_path', 'uses' => 'RegistrationController@store']);
Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path', 'uses' => 'RegistrationController@confirm']);
*/

/* Entrar o registrarse con Facebook o Google + */
Route::get('login_facebook', ['before' => 'guest', 'as' => 'login_facebook_path', 'uses' => 'SocialNetworksController@loginWithFacebook']);
Route::get('login_google', ['before' => 'guest', 'as' => 'login_google_path', 'uses' => 'SocialNetworksController@loginWithGoogle']);

/* Cargar notificaciones */
Route::get('cargar-notificaciones', ['before' => 'auth', 'as' => 'load_notification_path', 'uses' => 'NotificationsController@load']);

/* Vincular cuenta con Facebook o Google + */
Route::get('vincular_con_facebook', ['before' => 'auth', 'as' => 'link_facebook_path', 'uses' => 'SocialNetworksController@linkWithFacebook']);
Route::get('vincular_con_google', ['before' => 'auth', 'as' => 'link_google_path', 'uses' => 'SocialNetworksController@linkWithGoogle']);

/* Compratir en Facebook*/
Route::get('compartir/logro/{reached_achievement_id}', ['as' => 'share_social_achievement_path', 'uses' => 'SocialNetworksController@shareAchievement']);
Route::get('compartir/muro/{wall_message_id}', ['as' => 'share_social_wall_message_path', 'uses' => 'SocialNetworksController@shareWallMessage']);


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

/* Lista cursos*/
Route::get('cursos', ['as' => 'courses_path', 'uses' => 'CoursesController@index']);

/* Mis cursos*/
Route::get('mis-cursos', ['before' => 'auth', 'as' => 'my_courses_path', 'uses' => 'CoursesController@userCourses']);


/* Notificaciones */
Route::get('notificaciones', array('before' => 'auth', 'as' => 'notifications_path', 'uses' => 'NotificationsController@index'));
Route::get('notificaciones/{notification_id}', array('before' => 'auth', 'as' => 'show_notification_path', 'uses' => 'NotificationsController@show'));

/* Carne */
Route::get('curso/{course_id}/carne', ['as' => 'info_user_path', 'uses' => 'UsersController@infoUser']);

/* Curso */
Route::group(['prefix' => 'curso/{course_id}', 'before' => 'auth|isEnrolled'], function ()
{
    Route::get('/', ['as' => 'course_path', 'uses' => 'CoursesController@show']);

    /* Calendario */
    Route::get('/calendario', ['as' => 'calendar_path', 'uses' => 'CoursesController@calendar']);

    /* Muro */
    Route::get('/muro', ['as' => 'wall_path', 'uses' => 'WallMessagesController@index']);
    Route::post('/muro', ['as' => 'wall_save_message_path', 'uses' => 'WallMessagesController@storeMessage']);
    Route::post('/muro/{wall_message_id}/respuesta', ['as' => 'wall_save_reply_path', 'uses' => 'WallMessagesController@storeReply']);
    Route::put('/muro/editar', ['as' => 'wall_edit_message_path', 'uses' => 'WallMessagesController@update']);
    Route::delete('/muro/eliminar', ['as' => 'wall_delete_message_path', 'uses' => 'WallMessagesController@destroy']);
    Route::post('/muro/mensaje/megusta', ['as' => 'like_message_path', 'uses' => 'WallMessagesController@likeMessage']);
    Route::post('/muro/mensaje/yanomegusta', ['as' => 'unlike_message_path', 'uses' => 'WallMessagesController@unlikeMessage']);
    Route::get('/muro/mensaje/aquienlegusta', ['as' => 'who_like_message_path', 'uses' => 'WallMessagesController@whoLikeMessage']);

    /* Foro */
    Route::get('/foro', ['as' => 'forum_path', 'uses' => 'ForumController@index']);
    Route::get('/foro/{topic_id}', ['as' => 'topic_path', 'uses' => 'ForumController@show']);
    Route::post('/foro/{topic_id}/respuesta', ['as' => 'topic_save_reply_path', 'uses' => 'ForumController@storeReply']);
    Route::put('/foro/{topic_id}/editar', ['as' => 'topic_edit_reply_path', 'uses' => 'ForumController@updateReply']);
    Route::delete('/foro/{topic_id}/eliminar', ['as' => 'topic_delete_reply_path', 'uses' => 'ForumController@destroyReply']);
    Route::post('/foro/mensaje/megusta', ['as' => 'like_topic_reply_path', 'uses' => 'ForumController@likeTopicReply']);
    Route::post('/foro/mensaje/yanomegusta', ['as' => 'unlike_topic_reply_path', 'uses' => 'ForumController@unlikeTopicReply']);
    Route::get('/foro/mensaje/aquienlegusta', ['as' => 'who_like_topic_reply_path', 'uses' => 'ForumController@whoLikeTopicReply']);

    /* Ranking */
    Route::get('/ranking-grupal', ['as' => 'group_ranking_path', 'uses' => 'CoursesController@groupRanking']);
    Route::get('/ranking-individual', ['as' => 'individual_ranking_path', 'uses' => 'CoursesController@individualRanking']);

    /* Logros */
    Route::get('/logros', ['before' => 'isStudent', 'as' => 'achievement_path', 'uses' => 'CoursesController@reachedAchievements']);

    /* Modulo */
    Route::group(['prefix' => 'modulo/{module_id}'], function ()
    {
        Route::get('/', ['as' => 'module_path', 'uses' => 'ModulesController@show']);
        Route::post('/', ['as' => 'module_path', 'uses' => 'ModulesController@ajaxShow']);

        Route::put('/material/valorar', ['as' => 'store_material_review_path', 'uses' => 'MaterialsController@storeRewiews']);
        Route::get('/material/valoraciones/{material_id}', ['as' => 'load_material_reviews_path', 'uses' => 'MaterialsController@showRewiews']);

        /* Estadisticas materiales */
        Route::post('/material/video/playbacktime', ['as' => 'material_video_playbacktime_path', 'uses' => 'ModulesController@playbackTime']);

        /*Saltar evaluacion*/
        Route::post('/evaluacion/saltar', ['as' => 'skip_quiz_path', 'uses' => 'QuizzesController@skip']);

        /* CRUD */
        Route::post('/material/crear', ['before' => 'isTeacher', 'as' => 'store_material_path', 'uses' => 'MaterialsController@store']);
        Route::post('/quiz/crear', ['before' => 'isTeacher', 'as' => 'store_quiz_path', 'uses' => 'QuizzesController@store']);
        Route::post('/quiz/edit', ['before' => 'isTeacher', 'as' => 'edit_quiz_path', 'uses' => 'QuizzesController@update']);
    });

    /* Estadísticas */
    Route::group(['prefix' => 'estadisticas', 'before' => 'isMonitorOrTeacher'], function ()
    {
        Route::get('/estudiantes', ['as' => 'statistics_students_path', 'uses' => 'StatisticsController@students']);
        Route::get('/materiales', ['as' => 'statistics_materials_path', 'uses' => 'StatisticsController@materials']);
        Route::get('/reportes', ['as' => 'module_report_path', 'uses' => 'StatisticsController@moduleReport']);
        Route::post('/reportes/descargar', ['as' => 'download_module_report_path', 'uses' => 'StatisticsController@downloadModuleReport']);
        Route::get('/evaluaciones', ['as' => 'statistics_quizzes_path', 'uses' => 'StatisticsController@quizzes']);

    });

    Route::group(['prefix' => 'SCORM'], function ()
    {
        Route::post('/LMSInitialize', ['uses' => 'ApiSCORMController@LMSInitialize']);
        Route::post('/LMSFinish', ['uses' => 'ApiSCORMController@LMSFinish']);
        Route::post('/LMSSetValue', ['uses' => 'ApiSCORMController@LMSSetValue']);
        Route::post('/grade', ['uses' => 'ApiSCORMController@grade']);

    });

    Route::get('/compartir/logro/{achievementID}', ['as' => 'share_achievement_path', 'uses' => 'WallMessagesController@shareAchievement']);

});





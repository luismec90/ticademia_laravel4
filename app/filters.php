<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request)
{
    //
});


App::after(function ($request, $response)
{
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function ()
{
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        } else
        {
            return Redirect::guest('/');
        }
    }
});


Route::filter('auth.basic', function ()
{
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function ()
{
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function ()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});


/* Mis filtros */


Route::filter('isEnrolled', function ($route)
{
    $courseID = $route->getParameter('course_id');

    $course = Course::findOrFail($courseID);

    if (!Auth::user()->isStudent($course->id) && !Auth::user()->isMonitor($course->id) && !Auth::user()->isTeacher($course->id))
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        } else
        {
            return Redirect::home();
        }
    }

    $connection = Connection::where('course_id')->find(Session::get('connectionID', - 1));

    if (is_null($connection))
    {
        $connection = new Connection;
        $connection->user_id = Auth::user()->id;
        $connection->course_id = $course->id;
        $connection->save();
        Session::put('connectionID', $connection->id);
    } else
    {
        $connection->touch();
    }

});
Route::filter('isMonitorOrTeacher', function ($route)
{
    $courseID = $route->getParameter('course_id');

    if (!Auth::user()->isMonitor($courseID) && !Auth::user()->isTeacher($courseID))
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        } else
        {
            return Redirect::home();
        }
    }
});
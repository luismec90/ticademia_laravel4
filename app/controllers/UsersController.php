<?php

class UsersController extends \BaseController {

    public function showProfile()
    {
        $linkedWithFacebook = false;
        $linkedWithGoogle = false;

        $socialNetworks = SocialNetwork::where('user_id', Auth::user()->id)
            ->get();

        foreach ($socialNetworks as $socialNetwork)
        {
            if ($socialNetwork->name == "facebook")
            {
                $linkedWithFacebook = true;
            } else if ($socialNetwork->name == "google")
            {
                $linkedWithGoogle = true;
            }
        }

        return View::make('pages.profile.general_info', compact('linkedWithFacebook', 'linkedWithGoogle'));
    }

    public
    function changeAvatar()
    {

        $validation = Validator::make(Input::all(), User::$updateAvatar, User::$validationMessages);
        if ($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation);
        }

        $dataX = Input::get('dataX');
        $dataY = Input::get('dataY');
        $dataHeight = Input::get('dataHeight');
        $dataWidth = Input::get('dataWidth');

        $path = 'users/avatars/';

        if (Auth::user()->avatar != 'default.png' && File::exists($path . Auth::user()->avatar))
        {
            File::delete($path . Auth::user()->avatar);
        }
        $avatar = Input::file('avatar');
        $fileName = Auth::user()->id . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar->getRealPath())
            ->crop($dataWidth, $dataHeight, $dataX, $dataY)
            ->fit(300, 300)
            ->save("$path/$fileName");

        Auth::user()->avatar = $fileName;

        Auth::user()->save();

        Flash::success('Imagen actualizada exitosamente');

        return Redirect::back();
    }


    public
    function updateProfile()
    {

        $validation = Validator::make(Input::all(), User::$updateRules, User::$validationMessages);
        if ($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation);
        } else
        {
            Auth::user()->first_name = Input::get('first_name');
            Auth::user()->last_name = Input::get('last_name');
            Auth::user()->birth_date = Input::get('birth_date');
            Auth::user()->gender = Input::get('gender');
            Auth::user()->email = Input::get('email');

            Auth::user()->save();

            Flash::success('Sus datos se han actualizado exitosamente!');

            return Redirect::back();
        }
    }

    public
    function showPassword()
    {
        return View::make('pages.profile.change_password');
    }

    public
    function updatePassword()
    {
        $validation = Validator::make(Input::all(), User::$updatePasswordRules);
        if ($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation);
        } else
        {

            if (Auth::user()->password == "" || Hash::check(Input::get('old_password'), Auth::user()->password))
            {
                Auth::user()->password = Hash::make(Input::get('password'));
                Auth::user()->save();
                Flash::success('Su contraseña se ha actualizado exitosamente');
            } else
            {
                return Redirect::back()->withInput()->withErrors(['message' => 'La contraseña anterior no es correcta']);
            }

            return Redirect::back();
        }
    }

    public function infoUser($courseID)
    {
        $userID = Input::get('userID',1);

        $course = Course::findOrFail($courseID);
        $user = User::with('modules')->findOrFail($userID);
        $ranking = $course->generalRanking();
        $user->total_score = 0;
        $user->general_position = "N/A";
        foreach ($ranking as $index => $row)
        {
            if ($user->id == $row->id)
            {
                $user->total_score = $row->score;
                $user->general_position = $index + 1;
                break;
            }
        }

        $reachedAchievements = ReachedAchievement::with('achievement')
            ->where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->get();

        $level = Level::find(Auth::user()->courses->find($course->id)->pivot->level_id);

        return View::make('course.partials.modal_info_user', ['user' => $user, 'course' => $course, 'reachedAchievements' => $reachedAchievements, 'level' => $level]);
        // return Response::json(View::make('layouts.partials.modal_notification', ['title' => $notification->title, 'image' => $notification->image, 'body' => $notification->body])->render());
    }
}

<?php


class SessionsController extends \BaseController {

    public function store()
    {
        if (!Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'),'confirmed'=>'1'],Input::has('remember')))
        {
            Flash::error('Usuario o contraseña inválidos');

            return Redirect::back()->withInput();
        }

        AchievementHelper::achievement_timePlatformUse(Auth::user());

        Flash::success('Bienvenido nuevamante '.Auth::user()->nombres);

        return Redirect::back();

    }

    public function destroy()
    {
        Auth::logout();
        Session::flush();
        return Redirect::home();
    }
}

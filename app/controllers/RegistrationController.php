<?php

class RegistrationController extends \BaseController {


    public function create()
    {
        return View::make('registration.create');
    }

    public function store()
    {
        $validation = Validator::make(Input::all(), User::$rules);
        if ($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation);
        }

        $user = new User;
        $user->nombres = Input::get('nombres');
        $user->apellidos = Input::get('apellidos');
        $user->fecha_nacimiento = Input::get('fecha_nacimiento');
        $user->sexo = Input::get('sexo');
        $user->email = Input::get('email');
        $user->imagen = 'default.png';
        $user->password = Hash::make(Input::get('password'));
        $user->activo = '0';
        $user->save();

        //   Auth::login($user);

        Flash::success('Bienvenido a TICademia');

        return Redirect::home();
    }
}

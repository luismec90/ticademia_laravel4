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

        $confirmation_code = str_random(30);

        $user = new User;
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->birth_date = Input::get('birth_date');
        $user->gender = Input::get('gender');
        $user->email = Input::get('email');
        $user->avatar = 'default.png';
        $user->password = Hash::make(Input::get('password'));
        $user->confirmation_code = $confirmation_code;
        $user->save();

        //   Auth::login($user);

        Mail::send('emails.auth.verify', compact('confirmation_code', 'user'), function ($message)
        {
            $message->to(Input::get('email'), Input::get('first_name'))
                ->subject('Verificar correo electrónico');
        });


        Flash::success("¡Gracias por registrarse! Se ha enviado un correo de confirmación a: {$user->email}");

        return Redirect::route('home');
    }

    public function confirm($confirmation_code)
    {
        if (!$confirmation_code)
        {
            Flash::error('Link inválido');

        } else
        {
            $user = User::whereConfirmationCode($confirmation_code)->first();

            if (!$user)
            {
                Flash::error('Link inválido');

            } else
            {

                $user->confirmed = 1;
                $user->confirmation_code = null;
                $user->save();

                Auth::login($user);

                Flash::success("Gracias por verificar su correo electrónico");

                return Redirect::route('home');
            }
        }

        return Redirect::route('home');
    }
}

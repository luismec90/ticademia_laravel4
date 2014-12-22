<?php

class SocialNetworksController extends \BaseController {

    public function loginWithFacebook()
    {

        // get data from input
        $code = Input::get('code');

        // get fb service
        $fb = OAuth::consumer('Facebook');

        // check if code is valid

        // if code is provided get user data and sign in
        if (!empty($code))
        {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($fb->request('/me'), true);

            $isNewUser = false;

            $user = User::whereHas('socialNetworks', function ($query) use ($result)
            {
                $query->where('email', $result['email'])
                    ->where('name', 'facebook');
            })->first();

            if (is_null($user))
            {
                $user = User::where('email', $result['email'])->first();

                if (is_null($user))
                {
                    $isNewUser = true;

                    $user = new User;
                    $user->first_name = $result['first_name'];
                    $user->last_name = $result['last_name'];
                    $user->gender = ($result['gender'] == 'male') ? 'm' : 'f';
                    $user->email = $result['email'];
                    $user->avatar = 'default.png';
                    $user->confirmed = 1;
                    $user->save();

                    $this->emailVerified($user);
                } else if ($user->confirmed == 0)
                {
                    $user->confirmed = 1;
                    $user->confirmation_code = null;
                    $user->save();
                }

                $socialNetWork = new SocialNetWork;
                $socialNetWork->user_id = $user->id;
                $socialNetWork->email = $result['email'];
                $socialNetWork->name = 'facebook';
                $socialNetWork->save();
            }


            Auth::login($user);


            if ($isNewUser)
            {
                Flash::success("Te has registrado exitosamente");
            } else
            {
                if (Auth::user()->gender == 'f')
                {
                    $welcome = 'Bienvenida';
                } else if (Auth::user()->gender == 'm')
                {
                    $welcome = 'Bienvenido';
                } else
                {
                    $welcome = 'Bienvenid@';
                }

                Flash::success("$welcome de nuevo " . Auth::user()->first_name);
            }

            return Redirect::route('home');

        } // if not ask for permission first
        else
        {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to((string) $url);
        }

    }

    public function loginWithGoogle()
    {

        // get data from input
        $code = Input::get('code');

        // get google service
        $googleService = OAuth::consumer('Google');

        // check if code is valid

        // if code is provided get user data and sign in
        if (!empty($code))
        {
            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            $isNewUser = false;

            $user = User::whereHas('socialNetworks', function ($query) use ($result)
            {
                $query->where('email', $result['email'])
                    ->where('name', 'google');
            })->first();

            if (is_null($user))
            {
                $user = User::where('email', $result['email'])->first();

                if (is_null($user))
                {
                    $isNewUser = true;

                    $user = new User;
                    $user->first_name = $result['given_name'];
                    $user->last_name = $result['family_name'];
                    $user->email = $result['email'];
                    $user->avatar = 'default.png';
                    $user->confirmed = 1;
                    $user->save();

                    $this->emailVerified($user);

                } else if ($user->confirmed == 0)
                {
                    $user->confirmed = 1;
                    $user->confirmation_code = null;
                    $user->save();
                }

                $socialNetWork = new SocialNetWork;
                $socialNetWork->user_id = $user->id;
                $socialNetWork->email = $result['email'];
                $socialNetWork->name = 'google';
                $socialNetWork->save();
            }

            Auth::login($user);

            if ($isNewUser)
            {
                Flash::success("Te has registrado exitosamente");
            } else
            {
                if (Auth::user()->gender == 'f')
                {
                    $welcome = 'Bienvenida';
                } else if (Auth::user()->gender == 'm')
                {
                    $welcome = 'Bienvenido';
                } else
                {
                    $welcome = 'Bienvenid@';
                }

                Flash::success("$welcome  " . Auth::user()->first_name);
            }

            return Redirect::route('home');

        } // if not ask for permission first
        else
        {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to((string) $url);
        }
    }

    public function linkWithFacebook()
    {
        $code = Input::get('code');
        $fb = OAuth::consumer('Facebook');

        if (!empty($code))
        {
            $token = $fb->requestAccessToken($code);
            $result = json_decode($fb->request('/me'), true);


            $socialNetwork = SocialNetwork::where('email', $result['email'])
                ->where('name', 'facebook')
                ->first();

            if (is_null($socialNetwork))
            {
                $socialNetwork = new SocialNetWork;
                $socialNetwork->user_id = Auth::user()->id;
                $socialNetwork->email = $result['email'];
                $socialNetwork->name = 'facebook';
                $socialNetwork->save();

                Flash::success("Cuenta vinculada exitosamente");

            } else if ($socialNetwork->user->isMe())
            {
                Flash::success("La cuenta ya esta vinculada");
            } else
            {
                Flash::error("Esta cuenta de Facebook ya ha sido registrada con otro usuario");
            }

            return Redirect::route('profile_path');
        } else
        {
            $url = $fb->getAuthorizationUri();

            return Redirect::to((string) $url);
        }

    }

    public function linkWithGoogle()
    {
        $code = Input::get('code');
        $googleService = OAuth::consumer('Google');

        if (!empty($code))
        {
            $token = $googleService->requestAccessToken($code);
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            $socialNetwork = SocialNetwork::where('email', $result['email'])
                ->where('name', 'google')
                ->first();

            if (is_null($socialNetwork))
            {
                $socialNetwork = new SocialNetWork;
                $socialNetwork->user_id = Auth::user()->id;
                $socialNetwork->email = $result['email'];
                $socialNetwork->name = 'google';
                $socialNetwork->save();

                Flash::success("Cuenta vinculada exitosamente");

            } else if ($socialNetwork->user->isMe())
            {
                Flash::success("La cuenta ya esta vinculada");
            } else
            {
                Flash::error("Esta cuenta de Google ya ha sido registrada con otro usuario");
            }


            return Redirect::route('profile_path');
        } else
        {
            $url = $googleService->getAuthorizationUri();

            return Redirect::to((string) $url);
        }
    }

    public function unlinkWithFacebook()
    {
        $socialNetwork = SocialNetwork::where('user_id', Auth::user()->id)
            ->where('name', 'facebook')->delete();

        Flash::success("Cuenta desvinculada exitosamente");

        return Redirect::route('profile_path');
    }

    public function unlinkWithGoogle()
    {
        $socialNetwork = SocialNetwork::where('user_id', Auth::user()->id)
            ->where('name', 'google')->delete();

        Flash::success("Cuenta desvinculada exitosamente");

        return Redirect::route('profile_path');
    }

    private function emailVerified($user)
    {

        Mail::send('emails.auth.verified', compact('confirmation_code', 'user'), function ($message) use ($user)
        {
            $message->to($user->email, $user->first_name)
                ->subject('Bienvenid@ a TICademia');
        });
    }

}

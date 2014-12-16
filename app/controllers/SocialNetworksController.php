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
            $user = User::where('email', $result['email'])->first();
            if (is_null($user))
            {
                $user = new User;
                $user->first_name = $result['first_name'];
                $user->last_name = $result['last_name'];
                $user->gender = ($result['gender'] == 'male') ? 'm' : 'f';
                $user->email = $result['email'];
                $user->avatar = 'default.png';
                $user->confirmed = 1;
                $user->save();
            }


            Auth::login($user);

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

            $user = User::where('email', $result['email'])->first();

            if (is_null($user))
            {
                $user = new User;
                $user->first_name = $result['given_name'];
                $user->last_name = $result['family_name'];
                $user->email = $result['email'];
                $user->avatar = 'default.png';
                $user->confirmed = 1;
                $user->save();
            }

            Auth::login($user);

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
}

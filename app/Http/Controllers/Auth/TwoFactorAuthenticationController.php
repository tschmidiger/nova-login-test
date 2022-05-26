<?php

namespace App\Http\Controllers\Auth;

use Session;

class TwoFactorAuthenticationController
{

    public function enable()
    {

        if(Session::get('status') === 'two-factor-authentication-confirmed') {

            return response()->redirectTo(config('nova.path'));

        } else {

            return view('auth.2fa-enable');

        }


    }

}

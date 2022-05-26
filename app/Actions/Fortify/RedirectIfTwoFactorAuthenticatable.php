<?php

namespace App\Actions\Fortify;

class RedirectIfTwoFactorAuthenticatable extends \Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable
{

    protected function twoFactorChallengeResponse($request, $user)
    {

        $response = parent::twoFactorChallengeResponse($request, $user);

        // set redirect param for /vendor/laravel/nova/resources/js/pages/Login.vue
        return $response->setData([
            'redirect' => route('two-factor.login')
        ]);

    }

}

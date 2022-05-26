<?php

namespace App\Actions\Fortify;

class AttemptToAuthenticate extends \Laravel\Fortify\Actions\AttemptToAuthenticate
{
    public function handle($request, $next)
    {
        $response = parent::handle($request, $next);

        // if two-factor authentication is not enabled
        if($response->getData()->two_factor === false) {

            // set redirect param for /vendor/laravel/nova/resources/js/pages/Login.vue
            return $response->setData([
                'redirect' => route('two-factor.enable')
            ]);

        }

    }

}

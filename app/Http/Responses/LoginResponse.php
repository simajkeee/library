<?php

namespace App\Http\Responses;

use Laravel\Fortify\Http\Responses\LoginResponse as LR;

class LoginResponse extends LR
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json([
                'two_factor' => false,
                'user' => \Auth::check() ? \Auth::user() : null,
            ])
            : redirect()->intended(Fortify::redirects('login'));
    }
}

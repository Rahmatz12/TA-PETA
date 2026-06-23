<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;

class EnsureFrontendRequestsAreStateful
{
    public static function fromFrontend($request)
    {
        return $request->fromFrontend();
    }
}

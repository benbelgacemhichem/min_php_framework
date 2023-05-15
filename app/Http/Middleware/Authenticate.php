<?php

namespace App\Http\Middleware;

use App\Core\Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        return route('login');
    }
}

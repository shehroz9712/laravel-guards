<?php

namespace Laravel\Guards\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Guards\Helpers\LicenseManager;

class VerifyLicenseKey
{
    public function handle(Request $request, Closure $next)
    {
        if (!LicenseManager::isValid()) {
            abort(403, 'License key is not valid.');
        }

        return $next($request);
    }
}

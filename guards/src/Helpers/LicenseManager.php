<?php

namespace Guards\Guards\Helpers;

class LicenseManager
{
    public static function isValid()
    {
        $key = config('guards.license_key');
        // Basic example, real case: decrypt & verify from API or local DB
        return $key === env('LICENSE_KEY');
    }
}

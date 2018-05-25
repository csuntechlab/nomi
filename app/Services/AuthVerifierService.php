<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthVerifierContract;

class AuthVerifierService implements AuthVerifierContract
{
    /**
     * Description: Takes in user credentials, checks them against
     *              the CSUN/LDAP servers, and returns true or false
     *              based on whether the credentials are valid and
     *              whether the valid user is CSUN faculty or not.
     *
     * @param array $cred
     *
     * @return bool
     */
    public function isVerified(array $cred): bool
    {
        if (auth()->attempt($cred) && auth()->user()->rank) {
            return true;
        }

        return false;
    }
}

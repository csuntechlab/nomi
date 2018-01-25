<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthVerifierContract;

class AuthVerifierService implements AuthVerifierContract
{
    public function isVerified(array $cred): bool
    {
        if (auth()->attempt($cred)) {
            $user = auth()->user();
            if ($user->rank != null) {
                return true;
            }

            return false;
        }

        return false;
    }
}

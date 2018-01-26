<?php

declare(strict_types=1);

namespace App\Contracts;

interface AuthVerifierContract
{
    /**
     * Description: A contract for verifying users.
     *
     * @param array $cred
     *
     * @return bool
     */
    public function isVerified(array $cred): bool;
}

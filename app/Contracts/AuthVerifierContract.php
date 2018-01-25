<?php

declare(strict_types=1);

namespace App\Contracts;

interface AuthVerifierContract
{
    public function isVerified(array $cred): bool;
}

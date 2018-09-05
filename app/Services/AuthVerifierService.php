<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\AuthVerifierContract;
use App\ModelRepositoryInterfaces\ClassInstructorsTableRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthVerifierService implements AuthVerifierContract
{
    protected $repository = null;

    public function __construct(ClassInstructorsTableRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

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
        if (auth()->attempt($cred)) {
            $query = $this->repository
                ->verifyUserWasAtOnePointAClassInstructor(auth()->user()->user_id);
            if (null !== $query) {
                return true;
            }

        Auth::logout();
        return false;
        }
    }
}
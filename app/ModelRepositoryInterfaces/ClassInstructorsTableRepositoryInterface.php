<?php

declare(strict_types=1);

namespace App\ModelRepositoryInterfaces;

interface ClassInstructorsTableRepositoryInterface
{
    public function verifyUserWasAtOnePointAClassInstructor($userId);
}

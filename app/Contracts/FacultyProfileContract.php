<?php

declare(strict_types=1);

namespace App\Contracts;

interface FacultyProfileContract
{
    public function getFacultyProfile($email);
}

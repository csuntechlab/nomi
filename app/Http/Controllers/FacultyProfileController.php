<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\FacultyProfileContract;

class FacultyProfileController extends Controller
{
    protected $facultyProfileUtility;

    public function __construct(FacultyProfileContract $facultyProfileUtility)
    {
        $this->facultyProfileUtility = $facultyProfileUtility;
    }

    public function getFacultyProfile($email)
    {
        return $this->facultyProfileUtility->getFacultyProfile($email);
    }
}

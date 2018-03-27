<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\FacultyProfileContract;

class FacultyProfileController extends Controller
{
    protected $facultyProfileContract;

    public function __construct(FacultyProfileContract $facultyProfileContract)
    {
        $this->facultyProfileContract = $facultyProfileContract;
    }

    public function getFacultyProfile($email)
    {
        return $this->facultyProfileContract->getFacultyProfile($email);
    }
}

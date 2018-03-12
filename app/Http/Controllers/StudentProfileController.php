<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\StudentProfileContract;

class StudentProfileController extends Controller
{
    protected $studentProfileRetriever;

    public function __construct(StudentProfileContract $studentProfileContract)
    {
        $this->studentProfileRetriever = $studentProfileContract;
    }

    public function getProfile($email)
    {
        return $this->studentProfileRetriever->getStudentProfile($email);
    }
}

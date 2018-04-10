<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\StudentProfileContract;
use Illuminate\Http\Request;

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

    public function updateNotes(Request $request)
    {
        return $this->studentProfileRetriever->updateStudentNotes($request);
    }
}

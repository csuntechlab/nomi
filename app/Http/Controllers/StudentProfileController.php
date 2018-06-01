<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\StudentProfileContract;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    protected $studentProfileService;

    public function __construct(StudentProfileContract $studentProfileContract)
    {
        $this->studentProfileService = $studentProfileContract;
    }

    public function getProfile($email)
    {
        return $this->studentProfileService->getStudentProfile($email);
    }

    public function updateNotes(Request $request)
    {
        return $this->studentProfileService->updateStudentNotes($request);
    }
}

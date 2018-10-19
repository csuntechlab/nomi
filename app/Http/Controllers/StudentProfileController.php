<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\StudentProfileContract;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    protected $studentProfileUtility;

    public function __construct(StudentProfileContract $studentProfileUtility)
    {
        $this->studentProfileUtility = $studentProfileUtility;
    }

    public function getProfile($email)
    {
        return $this->studentProfileUtility->getStudentProfile($email);
    }

    public function updateNotes(Request $request)
    {
        $data = [
            'student_id' => $request->student_id,
            'notepad' => $request->notepad,
        ];

        return $this->studentProfileUtility->updateStudentNotes($data);
    }

    public function getProfileWithNoEmail(Request $request)
    {
        $data = [
            'student_id' => $request->student_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        return $this->studentProfileUtility
        ->getStudentProfileWithNoEmail($data);
    }
}

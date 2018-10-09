<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\StudentProfileContract;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    protected $studentProfileUtility;

    public function __construct(StudentProfileContract $studentProfileContract)
    {
        $this->studentProfileUtility = $studentProfileContract;
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
}

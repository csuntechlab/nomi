<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Models\Student;

class RosterRetrievalService implements RosterRetrievalContract
{
    protected $webResourceRetriever = null;

    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    public function getStudentsFromRoster($term, $course)
    {
        $roster = $this->webResourceRetriever->getRoster($term, $course);
        $members = \json_decode($roster)->members;
        $unsanitizedStudents = [];
        foreach ($members as $member) {
            if ($member->position != 'Instructor') {
                \array_push($unsanitizedStudents, $member);
            }
        }
        $studentsKeys = [];
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            \array_push($studentsKeys, $unsanitizedStudent->members_id);
        }
        $allStudentIds = Student::pluck('student_id');
        $allStudentIds = $allStudentIds->toArray();
        dd($allStudentIds);
    }
}

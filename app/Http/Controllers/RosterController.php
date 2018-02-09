<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RosterRetrievalContract;

class RosterController extends Controller
{
    protected $rosterRetriever = null;

    public function __construct(RosterRetrievalContract $rosterRetriever)
    {
        $this->rosterRetriever = $rosterRetriever;
    }

    public function getStudents($term, $course)
    {
        return $this->rosterRetriever->getStudentsFromRoster($term, $course);
    }

    public function shuffleStudents($term, $course)
    {
        $students = $this->getStudents($term, $course);
        $recognizedStudents = \array_filter($students, function ($student) {
            return $student['recognized'] == true;
        });
        $unrecognizedStudents = \array_filter($students, function ($student) {
            return $student['recognized'] == false;
        });
        \shuffle($recognizedStudents);
        \shuffle($unrecognizedStudents);

        return \array_merge($unrecognizedStudents, $recognizedStudents);
    }
}

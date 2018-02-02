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
        \shuffle($students);

        return $students;
    }
}

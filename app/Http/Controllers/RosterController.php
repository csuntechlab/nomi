<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RosterRetrievalContract;

class RosterController extends Controller
{
    protected $rosterUtility = null;

    public function __construct(RosterRetrievalContract $rosterUtility)
    {
        $this->rosterUtility = $rosterUtility;
    }

    public function getStudents($term, $course)
    {
        return $this->rosterUtility->getStudentsFromRoster($term, $course);
    }
}

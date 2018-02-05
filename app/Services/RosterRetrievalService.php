<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;

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
        $sanitizedStudents = [];
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            \array_push($sanitizedStudents, [
                'student_id' => $unsanitizedStudent->members_id,
                'display_name' => $unsanitizedStudent->first_name . ' ' . $unsanitizedStudent->last_name,
                'recognized' => false,
            ]);
        }

        return $sanitizedStudents;
    }
}

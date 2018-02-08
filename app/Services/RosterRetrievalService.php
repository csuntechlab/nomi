<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Illuminate\Support\Facades\DB;

class RosterRetrievalService implements RosterRetrievalContract
{
    protected $webResourceRetriever = null;

    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    /**
     * Uses the webResource API to grab the roster and return it in a format
     * that is usable by the application in the front end.
     *
     * @param $term
     * @param $course
     *
     * @return array
     */
    public function getStudentsFromRoster($term, $course)
    {
        // Grabs the roster information without the instructor
        $roster = $this->webResourceRetriever->getRoster($term, $course);
        $members = \json_decode($roster)->members;
        $unsanitizedStudents = [];
        foreach ($members as $member) {
            if ($member->position != 'Instructor') {
                \array_push($unsanitizedStudents, $member);
            }
        }

        // Cleans the student info so we only grab the fields we need
        $sanitizedStudents = [];
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            \array_push($sanitizedStudents, [
                'student_id' => $unsanitizedStudent->members_id,
                'display_name' => $unsanitizedStudent->first_name . ' ' . $unsanitizedStudent->last_name,
                'email' => $unsanitizedStudent->email,
                'recognized' => false,
            ]);
        }

        // Checks to see if a student is recognized by the professor
        // teaching this class
        $relationships = DB::table('recognitions')->where('professor_id', auth()->user()->user_id)->pluck('student_id')->toArray();
        foreach ($sanitizedStudents as &$sanitizedStudent) {
            if (\in_array($sanitizedStudent['student_id'], $relationships)) {
                $sanitizedStudent['recognized'] = true;
            }
        }

        return $sanitizedStudents;
    }
}

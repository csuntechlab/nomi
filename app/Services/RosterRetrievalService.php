<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Intervention\Image\ImageManager;

class RosterRetrievalService implements RosterRetrievalContract
{
    protected $webResourceUtility = null;
    protected $imageCRUDUtility = null;

    public function __construct(
        WebResourceRetrieverContract $webResourceUtility,
        ImageCRUDContract $imageCRUDUtility
    ) {
        $this->webResourceUtility = $webResourceUtility;
        $this->imageCRUDUtility = $imageCRUDUtility;
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
        $roster = $this->webResourceUtility->getRoster($term, $course);
        $rosterServiceResponse = $roster[0]["value"]->getBody()->getContents();
        $rosterServiceResponse = \json_decode($rosterServiceResponse);

        $rosterCanvasResponse = $roster[1]["value"]->getBody()->getContents();
        $rosterCanvasResponse = \json_decode($rosterCanvasResponse);
        $canvasPictures = $this->processCanvasResponse($rosterCanvasResponse);

        $students = $this->processMembers($rosterServiceResponse->members, $canvasPictures);
        return [$rosterServiceResponse->class_number => $students];
    }

    public function processCanvasResponse($rosterCanvasResponse)
    {
        $canvasAssocArray = [];
        foreach($rosterCanvasResponse as $canvasItem) {
            // $canvasAssocArray[$canvasItem->id] = $canvasItem->avatar_url;
            $canvasAssocArray[$canvasItem->email] = $canvasItem->avatar_url;
        }
        return $canvasAssocArray;
    }

    public function processMembers($members, $canvasPictures)
    {
        $imageManager = new ImageManager(['driver' => 'imagick']);
        $unsanitizedStudents = [];
        $memberIDs = [];

        foreach ($members as $member) {
            if ($member->position != 'Instructor') {
                \array_push($unsanitizedStudents, $member);
            }
        }

        foreach ($unsanitizedStudents as $student) {
            \array_push($memberIDs, $student->members_id);
        }

        $priorities = $this->imageCRUDUtility->getPriority($memberIDs);

        for ($i = 0; $i < \count($priorities); ++$i) {
            $unsanitizedStudents[$i]->image_priority = $priorities[$i];
        }
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            if (empty($unsanitizedStudent->image_priority)) {
                $unsanitizedStudent->image_priority = 'likeness';
            }
        }

        // Cleans the student info so we only grab the fields we need
        $sanitizedStudents = [];
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            \array_push($sanitizedStudents, $this->sanitizeStudent($unsanitizedStudent, $imageManager, $canvasPictures));
        }

        \usort($sanitizedStudents, function ($a, $b) {
            return \strcmp($a['last_name'], $b['last_name']);
        });

        $sortedStudents = $this->sortStudents($sanitizedStudents);

        return $sortedStudents;
    }

    public function sanitizeStudent($student, $imageManager = null, $canvasPictures = [])
    {
        if ($student->email == null) {
            $student->email = $student->first_name . $student->last_name . '@NOTREALEMAIL.net';
        }

        //$images = $this->webResourceUtility->gatherImageCorrectly($student);

        return [
            'student_id' => $student->members_id,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'display_name' => $student->display_name,
            'email' => $student->email,
            'email_uri' => $student->email_uri,
            'image_priority' => $student->image_priority,
            'images' => [
                'avatar' => array_key_exists($student->email, $canvasPictures) ?
                    $canvasPictures[$student->email] : 
                    env('MEDIA_URL').'student/media/'.$student->email_uri.'/avatar?source=true&secret='.urlencode(env('MEDIA_KEY')),
                'likeness' => env('MEDIA_URL').'student/media/'.$student->email_uri.'/likeness?source=true&secret='.urlencode(env('MEDIA_KEY'))
            ]
        ];
    }

    private function sortStudents($students)
    {
        \usort($students, function ($a, $b) {
            return $a['first_name'] <=> $b['first_name'];
        });

        return $students;
    }
}

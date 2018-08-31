<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Intervention\Image\ImageManager;

class RosterRetrievalService implements RosterRetrievalContract
{
    protected $webResourceRetriever = null;
    protected $imageCRUDContract = null;

    public function __construct(
        WebResourceRetrieverContract $webResourceRetriever,
        ImageCRUDContract $imageCRUDContract
    ) {
        $this->webResourceRetriever = $webResourceRetriever;
        $this->imageCRUDContract = $imageCRUDContract;
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
        $roster = $this->webResourceRetriever->getRoster($term, $course)->getBody()->getContents();

        return $this->processMembers(\json_decode($roster)->members);
    }

    public function processMembers($members)
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

        $priorities = $this->imageCRUDContract->getPriority($memberIDs);

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
            \array_push($sanitizedStudents, $this->sanitizeStudent($unsanitizedStudent, $imageManager));
        }

        \usort($sanitizedStudents, function ($a, $b) {
            return \strcmp($a['last_name'], $b['last_name']);
        });

        $sortedStudents = $this->sortStudents($sanitizedStudents);

        return $sortedStudents;
    }

    public function sanitizeStudent($student, $imageManager = null)
    {
        if ($imageManager == null) {
            $imageManager = new ImageManager(['driver' => 'imagick']);
        }

        if ($student->email == null) {
            $student->email = $student->first_name . $student->last_name . '@NOTREALEMAIL.net';
        }

        $email = \substr($email, 0, \strpos($email, '@'));

        return [
            'student_id' => $student->members_id,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'images' => [
                'likeness' => $student->likeness_photo,
                'avatar' => $student->avatar_photo,
                'official' => $student->official_photo,
            ],
            'name_recording' => $student->name_recording,
            'image_priority' => $student->image_priority,
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

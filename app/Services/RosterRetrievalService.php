<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Intervention\Image\Image;
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

    private function processMembers($members)
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

        // Cleans the student info so we only grab the fields we need
        $sanitizedStudents = [];
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            \array_push($sanitizedStudents, $this->sanitizeStudent($unsanitizedStudent, $imageManager));
        }

        \usort($sanitizedStudents, function ($a, $b) {
            return \strcmp($a['last_name'], $b['last_name']);
        });

        return $sanitizedStudents;
    }

    public function sanitizeStudent($student, $imageManager = null)
    {
        if ($imageManager == null) {
            $imageManager = new ImageManager(['driver' => 'imagick']);
        }

        $email = \str_replace('nr_', '', $student->email);
        $email = \substr($email, 0, \strpos($email, '@'));
        $imageLocation = 'likeness.jpg';

        // checks if image already exists
        if (\file_exists(env('IMAGE_UPLOAD_LOCATION') . $email . '/likeness.jpg')) {
            $imageLocation = $email . '/likeness.jpg';
        }

        $image = 'images/' . $imageLocation;

        /*
        if (!\property_exists($student, 'profile_image')) {
            $student->profile_image = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_profile_default.jpg');
        }

        if (!\property_exists($student, 'avatar_image')) {
            $student->avatar_image = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_avatar_default.jpg');
        }
        */

        return [
            'student_id' => $student->members_id,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'images' => [
                'likeness' => $image,
                'avatar' => 'images/student_avatar_default.jpg',
                'official' => 'images/student_profile_default.jpg',
            ],
            'image_priority' => $student->image_priority,
            'recognized' => false,
        ];
    }
}

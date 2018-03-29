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
        $imageManager = new ImageManager(['driver' => 'imagick']);
        $members = \json_decode($roster)->members;
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
            $email = \str_replace('nr_', '', $unsanitizedStudent->email);
            $email = \substr($email, 0, \strpos($email, '@'));
            $imageLocation = '/' . 'likeness.jpg';

            // checks if image already exists
            if (\file_exists(env('IMAGE_UPLOAD_LOCATION') . '/' . $email . '/' . 'likeness.jpg')) {
                $imageLocation = $email . '/' . 'likeness.jpg';
            }

            $image = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/' . $imageLocation)
                ->encode('data-url');

            if (!\property_exists($unsanitizedStudent, 'profile_image')) {
                $unsanitizedStudent->profile_image = (string) $imageManager
                    ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_profile_default.jpg')
                    ->encode('data-url');
            }

            if (!\property_exists($unsanitizedStudent, 'avatar_image')) {
                $unsanitizedStudent->avatar_image = (string) $imageManager
                    ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_avatar_default.jpg')
                    ->encode('data-url');
            }

            \array_push($sanitizedStudents, [
                'student_id' => $unsanitizedStudent->members_id,
                'first_name' => $unsanitizedStudent->first_name,
                'last_name' => $unsanitizedStudent->last_name,
                'email' => $unsanitizedStudent->email,
                'images' => [
                    'likeness' => $image,
                    'avatar' => $unsanitizedStudent->avatar_image,
                    'official' => $unsanitizedStudent->profile_image,
                ],
                'image_priority' => $unsanitizedStudent->image_priority,
                'recognized' => false,
            ]);
        }

        \usort($sanitizedStudents, function ($a, $b) {
            return \strcmp($a['last_name'], $b['last_name']);
        });

        return $sanitizedStudents;
    }
}

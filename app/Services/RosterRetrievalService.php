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

        foreach ($members as $member) {
            if ($member->position != 'Instructor') {
                \array_push($unsanitizedStudents, $member);
            }
        }

        // Cleans the student info so we only grab the fields we need
        $sanitizedStudents = [];
        foreach ($unsanitizedStudents as $unsanitizedStudent) {
            $email = \str_replace('nr_', '', $unsanitizedStudent->email);
            $email = \substr($email, 0, \strpos($email, '@'));
            $imageLocation = '/' . 'avatar.png';

            // checks if image already exists
            if (\file_exists(env('IMAGE_UPLOAD_LOCATION') . '/' . $email . '/' . 'avatar.jpg')) {
                $imageLocation = $email . '/' . 'avatar.jpg';
            }

            $image = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/' . $imageLocation)
                ->encode('data-url');

            if (!\property_exists($unsanitizedStudent, 'profile_image')) {
                $unsanitizedStudent->profile_image = (string) $imageManager
                    ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_profile_default.jpg')
                    ->encode('data-url');
            }

            if (!\property_exists($unsanitizedStudent, 'likeness_image')) {
                $unsanitizedStudent->likeness_image = (string) $imageManager
                    ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_likeness_default.jpg')
                    ->encode('data-url');
            }

            \array_push($sanitizedStudents, [
                'student_id' => $unsanitizedStudent->members_id,
                'first_name' => $unsanitizedStudent->first_name,
                'last_name' => $unsanitizedStudent->last_name,
                'email' => $unsanitizedStudent->email,
                'images' => [
                    'likeness' => $unsanitizedStudent->likeness_image,
                    'avatar' => $image,
                    'profile' => $unsanitizedStudent->profile_image,
                ],
                'image_priority' => $this->imageCRUDContract->getPriority($unsanitizedStudent->members_id),
                'recognized' => false,
            ]);
        }

        \usort($sanitizedStudents, function ($a, $b) {
            return \strcmp($a['last_name'], $b['last_name']);
        });

        return $sanitizedStudents;
    }
}

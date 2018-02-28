<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

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
        $imageManager = new ImageManager(['driver' => 'imagick']);

        if ($roster->getStatusCode() == 204) {
            return [
                [
                    'student_id' => 999999999,
                    'display_name' => 'John Bingus',
                    'email' => 'jbingus@dingus.com',
                    'image' => (string) $imageManager->make(env('IMAGE_UPLOAD_LOCATION') . '/avatar.png')->encode('data-url'),
                    'recognized' => false,
                ],

                [
                    'student_id' => 999999998,
                    'display_name' => 'Bob Dingus',
                    'email' => 'bdingus@jingus.com',
                    'image' => (string) $imageManager->make(env('IMAGE_UPLOAD_LOCATION') . '/avatar.png')->encode('data-url'),
                    'recognized' => false,
                ],
            ];
        }

        $roster = $roster->getBody()->getContents();

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

            $image = (string) $imageManager->make(env('IMAGE_UPLOAD_LOCATION') . '/' . $imageLocation)->encode('data-url');
            \array_push($sanitizedStudents, [
                'student_id' => $unsanitizedStudent->members_id,
                'display_name' => $unsanitizedStudent->first_name . ' ' . $unsanitizedStudent->last_name,
                'email' => $unsanitizedStudent->email,
                'image' => $image,
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

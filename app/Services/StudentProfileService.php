<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\StudentProfileContract;
use App\Contracts\WebResourceRetrieverContract;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class StudentProfileService implements StudentProfileContract
{
    protected $webResourceRetriever = null;

    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    public function getStudentProfile($email)
    {
        $student = $this->webResourceRetriever->getStudent($email);
        $imageManager = new ImageManager(['driver' => 'imagick']);

        $profile = \json_decode($student, true)['people'];

        if ($profile['profile_image'] == null) {
            $profile['profile_image'] = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_profile_default.jpg')
                ->encode('data-url');
        }

        $studentProfile = [
            'display_name' => $profile['display_name'],
            'email' => $profile['email'],
            'image' => $profile['profile_image'],
        ];

        return $studentProfile;
    }
}

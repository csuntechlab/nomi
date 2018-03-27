<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\FacultyProfileContract;
use App\Contracts\WebResourceRetrieverContract;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class FacultyProfileService implements FacultyProfileContract
{
    protected $webResourceRetriever = null;

    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    public function getFacultyProfile($email)
    {
        $faculty = $this->webResourceRetriever->getFaculty($email);
        $imageManager = new ImageManager(['driver' => 'imagick']);

        $profile = \json_decode($faculty, true)['people'];

        if ($profile['profile_image'] == null) {
            $image = (string) $imageManager->make(env('IMAGE_UPLOAD_LOCATION') . '/faculty_profile_default.jpg')->encode('data-url');
            $profile['profile_image'] = $image;
        }

        $facultyProfile = [
            'display_name' => $profile['display_name'],
            'email' => $profile['email'],
            'image' => $profile['profile_image'],
        ];

        return $facultyProfile;
    }
}

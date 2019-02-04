<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\FacultyProfileContract;
use App\Contracts\WebResourceRetrieverContract;

class FacultyProfileService implements FacultyProfileContract
{
    protected $webResourceUtility = null;

    public function __construct(WebResourceRetrieverContract $webResourceUtility)
    {
        $this->webResourceUtility = $webResourceUtility;
    }

    public function getFacultyProfile($email)
    {
        $emailUri = \substr($email, 0, \strpos($email, '@'));

        $mediaURI = env('MEDIA_URL') . 'faculty/media/' . $emailUri . '/avatar/?source=true';

        // if (is_null($member['profile_image'])) {
        //     $member['profile_image'] = asset('images/likeness.jpg');
        // }

        return [
            'image' => $mediaURI,
            'id' => auth()->user()->user_id,
            'name_first' => auth()->user()->first_name,
            'name_last' => auth()->user()->last_name,
        ];
    }
}

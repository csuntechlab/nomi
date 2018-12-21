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
        $mediaURI = env('MEDIA_URL') . $email;

        // if (is_null($member['profile_image'])) {
        //     $member['profile_image'] = asset('images/likeness.jpg');
        // }

        return [
            'image' => $mediaURI,
            'id' => Auth()->User()->user_id,
            'name_first' => Auth()->User()->first_name,
            'name_last' => Auth()->User()->last_name,
        ];
    }
}

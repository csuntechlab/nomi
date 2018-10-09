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
        $faculty = $this->webResourceUtility->getStudent($email);

        $member = \json_decode($faculty, true)['people'];

        // if (is_null($member['profile_image'])) {
        //     $member['profile_image'] = asset('images/likeness.jpg');
        // }

        return [
            'image' => $member['profile_image'],
            'id' => $member['individuals_id'],
            'name_first' => $member['first_name'],
            'name_last' => $member['last_name']
        ];
    }
}

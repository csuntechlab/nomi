<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\FacultyProfileContract;
use App\Contracts\WebResourceRetrieverContract;

class FacultyProfileService implements FacultyProfileContract
{
    protected $webResourceRetriever = null;

    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    public function getFacultyProfile($email)
    {
        $faculty = $this->webResourceRetriever->getStudent($email);

        $profile = \json_decode($faculty, true)['people'];

        return $profile['profile_image'];
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CurriculumRetrieverContract;
use GuzzleHttp\Client;

class CurriculumRetrieverService implements CurriculumRetrieverContract
{
    public function getCourses()
    {
        $client = new Client();

        return $client->get(
            'http://api.metalab.csun.edu/curriculum/api/terms/Spring-2015/classes/comp'
        )->getBody()->getContents();
    }
}

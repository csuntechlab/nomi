<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\WebResourceRetrieverContract;
use GuzzleHttp\Client;

class WebResourceRetrieverService implements WebResourceRetrieverContract
{
    /**
     * Retrieves course list from CSUN Curriculum web service.
     *
     * @return string
     */
    public function getCourses()
    {
        $client = new Client();

        return $client->get(
            'http://api.metalab.csun.edu/curriculum/api/terms/Spring-2015/classes/comp'
        )->getBody()->getContents();
    }

    /**
     * Retrieves roster from META+LAB Roster web service.
     *
     * @return string
     */
    public function getRoster()
    {
        $client = new Client();

        return $client->get(
            'http://api.sandbox.csun.edu/metalab/roster/terms/current/memberships/steven.fitzgerald@csun.edu/classes'
        )->getBody()->getContents();
    }
}

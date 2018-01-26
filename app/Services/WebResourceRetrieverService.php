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

        //str_replace for testing purposes with dev db, to be removed
        return $client->get(
            'http://api.metalab.csun.edu/curriculum/api/classes?instructor=' . \str_replace('nr_', '', auth()->user()->email)
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
            'http://api.sandbox.csun.edu/metalab/roster/terms/current/memberships/'
            . \str_replace('nr_', '', auth()->user()->email) . '/classes'
        )->getBody()->getContents();
    }
}

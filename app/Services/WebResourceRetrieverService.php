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
     * @param $term
     *
     * @return string
     */
    public function getCourses($term)
    {
        $client = new Client();

        return \json_decode($client->get(
            env('COURSES_URL') . '/' . $term . '/classes?instructor=' . auth()->user()->email
        )->getBody()->getContents())->classes;
    }

    /**
     * Retrieves roster from META+LAB Roster web service.
     *
     * @param $term,
     * @param $course
     *
     * @return string
     */
    public function getRoster($term, $course)
    {
        $client = new Client();

        return $client->get(
            env('ROSTER_URL') . '/terms' . '/' . ($this->getCourses($term))[$course]->term
            . '/classes' . '/' . ($this->getCourses($term))[$course]->class_number
        )->getBody()->getContents();
    }

    /**
     * Retrieves media from META+LAB Media web service.
     *
     * @return string
     */
    public function getMedia()
    {
        $client = new Client();

        //hacky fix to remove @csun.edu
        return $client->get(
            'http://media.sandbox.csun.edu/api/1.0/faculty/media/'
            . \explode('@', \str_replace('nr_', '', auth()->user()->email))[0]
        )->getBody()->getContents();
    }
}

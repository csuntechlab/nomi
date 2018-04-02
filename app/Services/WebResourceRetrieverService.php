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

        $data =
            \json_decode(
                $client->get(
                    env('COURSES_URL') . '/' . $term . '/classes?instructor=' . auth()->user()->email
            )->getBody()
            ->getContents()
            )
            ->classes;

        //add an id to each object to make vue stuff easier
        $i = 0;
        foreach ($data as $course) {
            $course->id = $i;
            ++$i;
        }

        return $data;
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
        $class = $this->getCourses($term)[$course];

        return $client->get(env('ROSTER_URL') . '/terms' . '/' . $class->term . '/classes' . '/' . $class->class_number);
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

    public function getStudent($email)
    {
        $client = new Client();

        return $client->get(
            'https://api.metalab.csun.edu/directory/api/members?email='
            . \str_replace('nr_', '', $email)
        )->getBody()->getContents();
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\WebResourceRetrieverContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

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
                    env('COURSES_URL') . $term . '/classes?instructor=' . auth()->user()->email,
                    ['verify' => false]
            )->getBody()
            ->getContents()
            )->classes;

        //add an id to each object to make vue stuff easier
        $i = 0;
        foreach ($data as $course) {
            $course->id = $i;
            ++$i;
        }

        //ensure array is sorted by class_number
        usort($data, function($item,$item2) {
            return strcmp($item->class_number, $item2->class_number);
        });

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

        try {
            return env('APP_ENV') == 'production' ?
                $client->get(
                    env('ROSTER_URL') . 'terms/' . $class->term . '/classes/' . $class->class_number,
                    ['verify' => false, 'auth' => [env('ROSTER_USERNAME'), env('ROSTER_PASSWORD')]]
                )
                : $client->get(
                    env('ROSTER_URL') . 'terms/' . $class->term . '/classes/' . $class->class_number,
                    ['verify' => false]
                );
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }

    /**
     * Retrieves media from META+LAB Media web service.
     *
     * @param mixed $email
     *
     * @return string
     */
    public function getMedia($email)
    {
        $client = new Client();

        //hacky fix to remove @csun.edu
        return $client->get(
            'http://api.sandbox.csun.edu/metalab/test/media/1.1/' . $emailUri . '/photo'
            . \explode('@', \str_replace('nr_', '', $email))[0],
            ['verify' => false]
        )->getBody()->getContents();
    }

    public function getStudent($email)
    {
        $client = new Client();

        return $client->get(
            env('DIRECTORY_URL') . $email . '?secret=' . urlencode(env('DIRECTORY_SECRET_KEY')),
            ['verify' => false]
        )->getBody()->getContents();
    }

    public function gatherImageCorrectly($student)
    {
        $client = new Client();

        $likeness_json =
            \json_decode(
                $client->get($student->likeness_photo, ['verify' => false])
                ->getBody()
                ->getContents()
        );

        $likeness_image = $likeness_json->likeness_image;

        $avatar_json = \json_decode(
            $client->get($student->avatar_photo, ['verify' => false])
        ->getBody()
        ->getContents()
        );

        $avatar_image = $avatar_json->avatar_image;

        return [
            'likeness' => $likeness_image,
            'avatar' => $avatar_image,
        ];
    }
}

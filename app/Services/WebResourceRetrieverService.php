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
        foreach ($data as $course) {
            $course->id = $course->class_number;
        }

        //ensure array is sorted by class_number
        \usort($data, function ($item, $item2) {
            return \strcmp($item->class_number, $item2->class_number);
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

        $courseId = "0";

        $canvasHeaders = ['Authorization' => 'Bearer ' . env('BEARER_AUTH')];

        $getCanvasCourseId = $client->get('https://canvas.csun.edu/api/v1/courses?per_page=50',
            ['headers' => $canvasHeaders])->getBody()->getContents();
        $getCanvasCourseId = \json_decode($getCanvasCourseId);

        foreach($getCanvasCourseId as $courseItem) {
            if(!isset($courseItem->sis_course_id)){
                continue;
            }
            if($course == explode("-", $courseItem->sis_course_id)[1]){
                $courseId = $courseItem->id;
            }
        }

        try {
            $promise1 = env('APP_ENV') == 'production' ? 
                $client->getAsync(env('ROSTER_URL') . 'terms/' . $term . '/classes/' . $course, 
                ['verify' => False, 'auth' => [env('ROSTER_USERNAME'), env('ROSTER_PASSWORD')]])
                :  $client->getAsync(env('ROSTER_URL') . 'terms/' . $term . '/classes/' . $course,
                ['verify' => False]);
            $promise2 = $client->getAsync(env('CANVAS_COURSES_URL') . $courseId . '/users?per_page=50&include[]=avatar_url&include[]=email',
                        ['headers' => $canvasHeaders]);

            $promises = [$promise1];
            if($courseId != "0") {
                array_push($promises, $promise2);
            }

            $results = \GuzzleHttp\Promise\settle($promises)->wait();
            return $results;
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
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

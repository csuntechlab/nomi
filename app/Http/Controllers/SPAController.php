<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use Illuminate\Support\Facades\Cache;

class SPAController extends Controller
{
    public $rosterRetrievalContract;
    public $webResourceRetrieverContract;
    public $web;
    public $minutes;

    public function __construct(
        RosterRetrievalContract $rosterRetrievalContract,
        WebResourceRetrieverContract $webResourceRetrieverContract
    ) {
        $this->rosterRetrievalContract = $rosterRetrievalContract;
        $this->webResourceRetrieverContract = $webResourceRetrieverContract;
        $this->minutes = 27;
    }

    /**
     * Description: Gets the course/roster data for the SPA.
     */
    public function getData()
    {
        $courses = Cache::remember('courses', $this->minutes, function () {
            return $this->webResourceRetrieverContract->getCourses(env('CURRENT_TERM'));
        });

        if (\is_string($courses)) {
            $courses = \json_decode($courses);
        }

        $students = [];
        $len = \count($courses);

        for ($i = 0; $i < $len; ++$i) {
            $student =
                Cache::remember('students_' . $i, $this->minutes, function () use ($i) {
                    return $this->rosterRetrievalContract->getStudentsFromRoster(env('CURRENT_TERM'), $i);
                });

            if (\is_string($student)) {
                $student = \json_decode($student);
            }

            \array_push($students, $student);

            $courses[$i]->roster = $student;
        }

        return ['courses' => $courses, 'students' => $students];
    }

    /**
     * Description: Gets the index page of the SPA.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('spa');
    }
}

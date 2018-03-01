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
     * Description: Gets the index page of the SPA.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $courses = Cache::remember('courses', $this->minutes, function () {
            return $this->webResourceRetrieverContract->getCourses(env('CURRENT_TERM'));
        });

        $students = [];
        $len = \count($courses);

        for ($i = 0; $i < $len; ++$i) {
            \array_push(
                $students,
                Cache::remember('students_' . $i, $this->minutes, function () use ($i) {
                    return $this->rosterRetrievalContract->getStudentsFromRoster(env('CURRENT_TERM'), $i);
                })
            );
        }
        
        if ($students == null)
            return view('spa')->with('json', $json)->withErrors(['Failed to retrieve students.']);

        $json = [$courses, $students];

        return view('spa')->with('json', $json);
    }
}

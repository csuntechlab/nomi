<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\UserSettingsContract;
use App\Contracts\WebResourceRetrieverContract;
use Illuminate\Support\Facades\Cache;

class SPAController extends Controller
{
    public $rosterRetrievalContract;
    public $webResourceRetrieverContract;
    public $userSettings;
    public $web;
    public $minutes;

    public function __construct(
        RosterRetrievalContract $rosterRetrievalContract,
        WebResourceRetrieverContract $webResourceRetrieverContract,
        UserSettingsContract $userSettings
    ) {
        $this->rosterRetrievalContract = $rosterRetrievalContract;
        $this->webResourceRetrieverContract = $webResourceRetrieverContract;
        $this->userSettings = $userSettings;
        $this->minutes = 27;
    }

    /**
     * Description: Gets the course/roster data for the SPA.
     *
     * @param null|mixed $term
     */
    public function getData($term = null)
    {
        $id = auth()->user() ? auth()->user()->getAuthIdentifier() : 'default';

        if (Cache::has('courses:' . $id)) {
            $courses = Cache::get('courses:' . $id);
        } else {
            if ($term == null) {
                $term = $this->userSettings->getCurrentTerm();
            }
            $courses = $this->webResourceRetrieverContract->getCourses($term);
            Cache::put('courses:' . $id, $courses, $this->minutes);
        }

        $students = [];
        $len = \count($courses);

        for ($i = 0; $i < $len; ++$i) {
            if (Cache::has('students:' . $i . ':' . $id)) {
                $students[$i] = Cache::get('students:' . $i . ':' . $id);
            } else {
                $students[$i] = $this->rosterRetrievalContract->getStudentsFromRoster(env('CURRENT_TERM'), $i);
                Cache::put('students:' . $i . ':' . $id, $students[$i], $this->minutes);
            }

            $courses[$i]->roster = $students[$i];
        }
        $user = auth()->user();
        $email = $user->email;

        return ['courses' => $courses, 'students' => $students, 'email' => $email];
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

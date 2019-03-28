<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\CacheContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\UserSettingsContract;

class SPAController extends Controller
{
    public $userSettingsUtility;
    public $cacheUtility;
    public $minutes;
    protected $rosterRetrievalUtility;

    public function __construct(
        UserSettingsContract $userSettingsUtility,
        CacheContract $cacheUtility,
        RosterRetrievalContract $rosterRetrievalUtility
    ) {
        $this->userSettingsUtility = $userSettingsUtility;
        $this->minutes = 27;
        $this->cacheUtility = $cacheUtility;
        $this->rosterRetrievalUtility = $rosterRetrievalUtility;
    }

    public function getCurrentTerm($term = null)
    {
        if ($term == null) {
            $term = $this->userSettingsUtility->getCurrentTerm();
        }
        $term['display_term'] = \str_replace('-', ' ', $term['term']);
        return ['term' => $term];
    }

    public function getCourses($term)
    {
        $id = auth()->user() ? auth()->user()->getAuthIdentifier() : 'default';
        $courses = $this->cacheUtility->cacheCourses($id, $term, $this->minutes);
        return ['courses' => $courses];
    }

    public function getRoster($term, $course)
    {
        $students = $this->rosterRetrievalUtility->getStudentsFromRoster($term, $course);
        return response()->json([
            'allStudents' => $students,
            'students' => $students,
        ]);
    }

    /**
     * Description: Gets the index page of the SPA.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $previousTerm = $this->userSettingsUtility->getPreviousTerm();
        $nowAndNext = $this->userSettingsUtility->getNowAndNextTerm();
        $terms = $previousTerm->merge($nowAndNext);
        $previous['previous'] = empty($terms[0]) ? null :  $terms[0];
        $current['current'] = empty($terms[1]) ? null : $terms[1];
        $next['next'] = empty($terms[2]) ? null : $terms[2];
        $terms = \json_encode(\array_merge($previous, $current, $next));
        session(['profile' => $user]);
        session(['terms' => $terms]);
        return view('spa');
    }
}

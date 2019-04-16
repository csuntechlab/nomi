<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\UserSettingsContract;
use App\Contracts\WebResourceRetrieverContract;

class SPAController extends Controller
{
    public $userSettingsUtility;
    public $webResourceRetrieverUtility;
    protected $rosterRetrievalUtility;

    public function __construct(
        UserSettingsContract $userSettingsUtility,
        WebResourceRetrieverContract $webResourceRetrieverUtility,
        RosterRetrievalContract $rosterRetrievalUtility
    ) {
        $this->userSettingsUtility = $userSettingsUtility;
        $this->webResourceRetrieverUtility = $webResourceRetrieverUtility;
        $this->rosterRetrievalUtility = $rosterRetrievalUtility;
    }

    public function getCurrentTerm($term = null)
    {
        if ($term == null) {
            $term = $this->userSettingsUtility->getCurrentTerm();
        }
        return response()->json(['term' => $term]);
    }

    public function getCourses($term)
    {
        $courses = $this->webResourceRetrieverUtility->getCourses($term);
        return response()->json(['courses' => $courses]);
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

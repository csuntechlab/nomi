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
        $allStudents = $this->allStudents($students);
        return [
            'students' => $students,
            'allStudents' => $allStudents
        ];
    }

    /**
     * Description: Gets the course/roster data for the SPA.
     *
     * @param null|mixed $term
     */
    public function getData($term = null)
    {
        $id = auth()->user() ? auth()->user()->getAuthIdentifier() : 'default';
        $term = $this->getCurrentTerm($term);

        $courses = $this->cacheUtility->cacheCourses($id, $term, $this->minutes);

        $students = [];
        $len = \count($courses);

        $students = $this->cacheUtility->cacheStudents($students, $courses, $len, $id, $term, $this->minutes);

        $user = auth()->user();
        $email = $user->email;

        $allStudents = $this->allStudents($students);

        return [
            'courses' => $courses,
            'students' => $students,
            'allStudents' => $allStudents,
            'email' => $email,
            'term' => "$term",
        ];
    }

    /**
     * Description: Gets the index page of the SPA.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $emailUri = \substr($user->email, 0, \strpos($user->email, '@'));
        $user['image'] = env('MEDIA_URL') . 'faculty/media/' . $emailUri . '/avatar?source=true';
        $user['email_uri'] = $emailUri;
        $term = $this->userSettingsUtility->getCurrentTerm();
        $term['display_term'] = \str_replace('-', ' ', $term['term']);
        session(['profile' => $user]);
        session(['term' => $term]);
        return view('spa');
    }

    private function allStudents($students): array
    {
        $allStudents = [];

        foreach ($students as $class) {
            $allStudents = \array_merge($allStudents, $class);
        }

        $allStudents = \array_unique($allStudents, SORT_REGULAR);

        return $allStudents;
    }
}

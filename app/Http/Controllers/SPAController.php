<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserSettingsContract;
use App\Contracts\CacheContract;

use Illuminate\Support\Facades\Cache;

class SPAController extends Controller
{
    public $userSettingsUtility;
    public $cacheUtility;
    public $web;
    public $minutes;

    public function __construct(
        UserSettingsContract $userSettingsUtility,
        CacheContract $cacheUtility
    ) {
        $this->userSettingsUtility = $userSettingsUtility;
        $this->minutes = 27;
        $this->cacheUtility = $cacheUtility;
    }

    private function getCurrentTerm($term) {
       
        if (env('CURRENT_TERM') && $term == null) {
            $term = env('CURRENT_TERM');
        }

        if ($term == null) {
            $term = $this->userSettingsUtility->getCurrentTerm();
        }
        return $term;
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

        $allStudents = [];

        foreach ($students as $class) {
            $allStudents = \array_merge($allStudents, $class);
        }

        $allStudents = \array_unique($allStudents, SORT_REGULAR);

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
        return view('spa');
    }
}

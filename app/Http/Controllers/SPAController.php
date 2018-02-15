<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RosterRetrievalContract;
use Illuminate\Support\Facades\Cache;

class SPAController extends Controller
{
    public $rosterRetrievalContract;
    public $minutes;

    public function __construct(RosterRetrievalContract $rosterRetrievalContract)
    {
        $this->rosterRetrievalContract = $rosterRetrievalContract;
        $this->minutes = 27;
    }

    /**
     * Description: Gets the index page of the SPA.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //getStudentsFromRoster might need to be refactored, this call only grabs first class from current term
        //If students exist in cache, webservice is not called again; cache times out in $minutes minutes
        $students = Cache::remember('students', $this->minutes, function () {
            return $this->rosterRetrievalContract->getStudentsFromRoster(env('CURRENT_TERM'), 0);
        });

        return view('students')->with('students', $students);
    }
}

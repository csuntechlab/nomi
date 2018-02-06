<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\AuthVerifierContract;
use App\Contracts\RosterRetrievalContract;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authVerifierContract;
    protected $rosterRetrievalContract;

    /**
     * LoginController constructor.
     *
     * @param AuthVerifierContract    $authVerifierContract
     * @param RosterRetrievalContract $rosterRetrievalContract
     */
    public function __construct(
        AuthVerifierContract $authVerifierContract,
        RosterRetrievalContract $rosterRetrievalContract
    ) {
        $this->authVerifierContract = $authVerifierContract;
        $this->rosterRetrievalContract = $rosterRetrievalContract;
    }

    /**
     * Description: Returns the welcome screen view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Description: Logs in a user by authenticating them against
     *              the LDAP servers using the authVerifierContract.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function validateUser(Request $request)
    {
        $credentials = $request->all('username', 'password');
        if ($this->authVerifierContract->isVerified($credentials)) {
            //getStudentsFromRoster might need to be refactored, this call only grabs first class from current term
            $students = $this->rosterRetrievalContract->getStudentsFromRoster(env('CURRENT_TERM'), 0);
            //dd($students);

            return redirect()->route('home')->with('students', $students);
        }

        return redirect()->route('login');
    }
}

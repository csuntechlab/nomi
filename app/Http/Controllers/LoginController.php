<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\AuthVerifierContract;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authVerifierContract;

    /**
     * LoginController constructor.
     *
     * @param AuthVerifierContract $authVerifierContract
     */
    public function __construct(
        AuthVerifierContract $authVerifierContract
    ) {
        $this->authVerifierContract = $authVerifierContract;
    }

    /**
     * Description: Returns the welcome screen view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()) {
            return redirect('home');
        }
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
            return redirect()->route('home');
        }

        return view('login')->withErrors(['Login Failed']);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\AuthVerifierContract;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authVerifierContract = null;

    public function __construct(AuthVerifierContract $authVerifierContract)
    {
        $this->authVerifierContract = $authVerifierContract;
    }

    public function index()
    {
        return view('welcome');
    }

    /**
     * Description:.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|int
     */
    public function validateUser(Request $request)
    {
        $credentials = $request->all('username', 'password');
        if ($this->authVerifierContract->isVerified($credentials)) {
            return 123;
        }

        return redirect()->route('welcome');
    }
}

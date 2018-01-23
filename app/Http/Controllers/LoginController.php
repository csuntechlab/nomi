<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function validateUser(Request $request)
    {
        $credentials = $request->all('username', 'password');
        if (auth()->attempt($credentials)) {
            echo 123;
        }
    }
}

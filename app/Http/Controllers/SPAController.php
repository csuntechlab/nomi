<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class SPAController extends Controller
{
    public function index()
    {
        return view('splash');
    }
}

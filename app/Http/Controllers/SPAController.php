<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class SPAController extends Controller
{
    /**
     * Description: Gets the index page of the SPA.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cards');
    }
}

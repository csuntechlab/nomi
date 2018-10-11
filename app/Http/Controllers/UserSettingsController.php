<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserSettingsContract;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    protected $settingsUtility;

    public function __construct(UserSettingsContract $settingsUtility)
    {
        $this->settingsUtility = $settingsUtility;
    }

    public function getSettings(Request $request)
    {
        return $this->settingsUtility->getSettings($request);
    }

    public function updateTheme(Request $request)
    {
        return $this->settingsUtility->updateTheme($request);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserSettingsContract;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    protected $settingsServiceUtility;

    public function __construct(UserSettingsContract $settings)
    {
        $this->settingsServiceUtility = $settings;
    }

    public function getSettings(Request $request)
    {
        return $this->settingsServiceUtility->getSettings($request);
    }

    public function updateTheme(Request $request)
    {
        return $this->settingsServiceUtility->updateTheme($request);
    }
}

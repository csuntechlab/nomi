<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserSettingsContract;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    protected $settingsService;

    public function __construct(UserSettingsContract $settings)
    {
        $this->settingsService = $settings;
    }

    public function getSettings(Request $request)
    {
        return $this->settingsService->getSettings($request);
    }

    public function updateTheme(Request $request)
    {
        return $this->settingsService->updateTheme($request);
    }
}

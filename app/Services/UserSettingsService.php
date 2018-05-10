<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserSettingsContract;
use App\Models\Theme;
use Illuminate\Http\Request;

class UserSettingsService implements UserSettingsContract
{
    public function getSettings()
    {
        $settings = new \stdClass();

        $settings->theme = Theme::where('user_id', auth()->user()->user_id)->first();

        return $settings;
    }

    public function updateTheme(Request $request)
    {
        $theme = Theme::updateOrCreate(
            ['user_id' => auth()->user()->user_id],
            ['theme' => $request->theme]
        );
    }
}

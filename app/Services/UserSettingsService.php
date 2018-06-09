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
        $theme = Theme::where('user_id', auth()->user()->user_id)->first();

        if (null === $theme) {
            $theme = 'theme-OnceAMatadorAlwaysAMatador';
        }

        return \json_encode(['theme' => $theme]);
    }

    public function updateTheme(Request $request)
    {
        Theme::updateOrCreate(
            ['user_id' => auth()->user()->user_id],
            ['theme' => $request->theme]
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserSettingsContract;
use App\Models\Term;
use App\Models\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserSettingsService implements UserSettingsContract
{
    public function getSettings()
    {
        $themeModel = Theme::where('user_id', auth()->user()->user_id)->first();

        if (null === $themeModel) {
            $theme = 'theme-OnceAMatadorAlwaysAMatador';
        } else {
            $theme = $themeModel->theme;
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

    public function getCurrentTerm()
    {
        $today = Carbon::now()->toDateTimeString();

        $term = Term::where('begin_date', '<=', $today)
                    ->where('end_date', '>=', $today)
                    ->first();

        if ($term != null) {
            return $term->term_id;
        }

        return 2173;
    }
}

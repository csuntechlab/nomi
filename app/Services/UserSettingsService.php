<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserSettingsContract;
use App\ModelRepositoryInterfaces\TermModelRepositoryInterface;
use App\Models\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserSettingsService implements UserSettingsContract
{
    protected $termModelRepositoryUtility = null;

    public function __construct(TermModelRepositoryInterface $termModelRepositoryUtility)
    {
        $this->termModelRepositoryUtility = $termModelRepositoryUtility;
    }

    public function getSettings()
    {
        $themeModel = Theme::where('user_id', auth()->user()->user_id)->first();

        if (null === $themeModel) {
            $theme = 'theme-matadorTheme';
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
        // grab real term if enviorment is production
        if (env('PROD')) {
            $today = Carbon::now()->toDateTimeString();
            $term = $this->termModelRepositoryUtility->find($today);
            if ($term != null) {
                return $term['term_id'];
            }
        }

        // this is what nomi uses for both testing and demo
        return 2173;
    }
}

<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\Request;

interface UserSettingsContract
{
    public function getSettings(Request $request);

    public function updateTheme(Request $request);
}

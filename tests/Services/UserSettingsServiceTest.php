<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Models\Term;
use App\Services\UserSettingsService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserSettingsServiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function getCurrentTerm_returns_current_term()
    {
        $this->markTestSkipped('broken');
        $testNow = Carbon::create(2014, 5, 20, 0, 0, 0);
        Carbon::setTestNow($testNow);

        factory(Term::class)->make()->save();

        $service = new UserSettingsService();

        $service->getCurrentTerm();
    }
}

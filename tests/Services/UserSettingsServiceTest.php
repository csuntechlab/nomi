<?php

declare(strict_types=1);

namespace Tests\Services;

use App\ModelRepositoryInterfaces\TermModelRepositoryInterface;
use App\Models\Theme;
use App\Models\User;
use App\Services\UserSettingsService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Tests\TestCase;

class UserSettingsServiceTest extends TestCase
{
    protected $termModelRepository;

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->termModelRepository = Mockery::spy(TermModelRepositoryInterface::class);
    }

    /** @test */
    public function getCurrentTerm_returns_current_term()
    {
        $service = new UserSettingsService($this->termModelRepository);

        $this->termModelRepository
          ->shouldReceive('find')
          ->Once()
          ->andReturn([
            'term_id' => 2193,
            'term' => 'Spring 2019',
            'description' => 'Spring Semester 2019',
            'begin_date' => '2019-01-22 00:00:00',
            'end_date' => '2019-05-24 23:59:59',
          ]);

        $this->assertArrayHasKey('term_id', $this->termModelRepository->find());
    }

    /** @test */
    public function getSettings_returns_the_proper_settings_for_the_logged_in_user()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        factory(Theme::class)->make([
            'user_id' => 'members:professor',
            'theme' => 'theme-blueTheme',
        ])->save();

        $service = new UserSettingsService($this->termModelRepository);

        $this->assertEquals($service->getSettings(), \json_encode(['theme' => 'theme-blueTheme']));
    }
}

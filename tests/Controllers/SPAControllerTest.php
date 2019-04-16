<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\UserSettingsContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Http\Controllers\SPAController;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mockery;
use Tests\TestCase;

class SPAControllerTest extends TestCase
{
    use WithoutMiddleware;

    public $userSettings;
    public $webResourceRetrieval;
    public $rosterRetrieval;

    /**
     * Description: Sets up the test and ignores Middleware.
     */
    public function setUp()
    {
        parent::setUp();
        $this->disableMiddlewareForAllTests();
        $this->userSettings = Mockery::spy(UserSettingsContract::class);
        $this->webResourceRetrieval = Mockery::spy(WebResourceRetrieverContract::class);
        $this->rosterRetrieval = Mockery::spy(RosterRetrievalContract::class);
    }

    /** @test */
    public function getData_hits_webservice_if_cache_empty()
    {
        $this->markTestSkipped('Revisit at later time.');
        $controller = new SPAController($this->userSettings, $this->webResourceRetrieval, $this->rosterRetrieval);
        
        Auth::shouldReceive('user')
        ->andReturn($user = Mockery::spy(User::class));
        
        $user->shouldReceive('email')
            ->andReturn('ThisIsAnEmail');

        $controller->getData();
    }
}

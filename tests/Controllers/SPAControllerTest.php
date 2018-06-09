<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Http\Controllers\SPAController;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Cache;
use Mockery;
use Tests\TestCase;

class SPAControllerTest extends TestCase
{
    use WithoutMiddleware;

    public $rosterRetriever;
    public $webResourceRetriever;

    /**
     * Description: Sets up the test and ignores Middleware.
     */
    public function setUp()
    {
        parent::setUp();
        $this->disableMiddlewareForAllTests();
        $this->rosterRetriever = Mockery::spy(RosterRetrievalContract::class);
        $this->webResourceRetriever = Mockery::spy(WebResourceRetrieverContract::class);
    }

    /** @test */
    public function getData_hits_webservice_if_cache_empty()
    {
        $controller = new SPAController($this->rosterRetriever, $this->webResourceRetriever);

        $this->webResourceRetriever
            ->shouldReceive('getCourses')
            ->andReturn([])
            ->once();

        Auth::shouldReceive('user')
            ->andReturn($user = Mockery::spy(User::class));

        $user->shouldReceive('email')
            ->andReturn('ThisIsAnEmail');

        $controller->getData();
    }

    /** @test */
    public function getData_does_not_hit_webservice_if_cache_not_empty()
    {
        $controller = new SPAController($this->rosterRetriever, $this->webResourceRetriever);
        Cache::forever('courses:default', []);
        Cache::forever('students:0:default', []);

        $this->rosterRetriever
            ->shouldReceive('getStudentsFromRoster')
            ->never();

        $this->webResourceRetriever
            ->shouldReceive('getCourses')
            ->once();

        Auth::shouldReceive('user')
            ->andReturn($user = Mockery::spy(User::class));

        $user->shouldReceive('email')
            ->andReturn('ThisIsAnEmail');

        $controller->getData();

        Cache::forget('courses:default', []);
        Cache::forget('students:0:default', []);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Http\Controllers\SPAController;
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
    public function index_hits_webservice_if_cache_empty()
    {
        $controller = new SPAController($this->rosterRetriever, $this->webResourceRetriever);
        $this->rosterRetriever
            ->shouldReceive('getStudentsFromRoster')
            ->once();
        $controller->index();
    }

    /** @test */
    public function index_does_not_hit_webservice_if_cache_not_empty()
    {
        $controller = new SPAController($this->rosterRetriever, $this->webResourceRetriever);
        Cache::forever('students', 'students');

        $this->rosterRetriever
            ->shouldReceive('getStudentsFromRoster')
            ->never();
        $controller->index();

        Cache::forget('students');
    }
}

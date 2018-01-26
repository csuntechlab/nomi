<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\WebResourceRetrieverContract;
use App\Http\Controllers\WebResourceController;
use Mockery;
use Tests\TestCase;

class WebResourceControllerTest extends TestCase
{
    public $retriever;

    /**
     * Description: Sets up the test and makes a mock of
     *              WebResourceRetriever.
     */
    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(WebResourceRetrieverContract::class);
    }

    /**
     * @test
     */
    public function courses_returns_JSON()
    {
        $controller = new WebResourceController($this->retriever);

        $this->retriever
            ->shouldReceive('getCourses')
            ->once();
    }

    /**
     * @test
     */
    public function roster_returns_JSON()
    {
        $controller = new WebResourceController($this->retriever);

        $this->retriever
            ->shouldReceive('getRoster')
            ->once();
    }
}

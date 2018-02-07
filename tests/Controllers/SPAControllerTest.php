<?php

declare(strict_types=1);

namespace Tests\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SPAControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Description: Sets up the test and ignores Middleware.
     */
    public function setUp()
    {
        parent::setUp();
        $this->disableMiddlewareForAllTests();
    }

    /**
     * Description: Checks that we can hit the index route.
     *
     * @test
     */
    public function can_hit_SPA_index_page()
    {
        $response = $this->call('GET', '/home');
        $this->assertEquals(200, $response->status());
    }
}

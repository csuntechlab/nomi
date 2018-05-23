<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\AuthVerifierContract;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * Description: Sets up the test and makes a mock of
     *              AuthVerifierContract.
     */
    public function setUp()
    {
        parent::setUp();
        $this->verifier = Mockery::spy(AuthVerifierContract::class);
    }

    /**
     * Description: Checks that we can hit the index route.
     *
     * @test
     */
    public function can_hit_login_index_page()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Description: Checks that logging in works using sample data
     *              and Mockery to simulate the AuthVerifierContract.
     *
     * @test
     */
    public function faculty_can_login()
    {
        $data = ['username' => 'steve', 'password' => ''];
        $controller = new LoginController($this->verifier);
        $request = new Request($data);

        $this->verifier
            ->shouldReceive('isVerified')
            ->once()
            ->with($data)
            ->andReturn(true);

        $response = $controller->validateUser($request);
        $this->assertEquals('http://localhost/home', $response->getTargetUrl());
    }

    /**
     * Description: Checks that logging in blocks users who are not
     *              authorized to use the application using sample data
     *              Mockery to simulate the AuthVerifierContract.
     *
     * @test
     */
    public function non_faculty_cannot_login()
    {
        $data = ['username' => 'jeffery.d.barrow', 'password' => ''];
        $controller = new LoginController($this->verifier);
        $request = new Request($data);

        $this->verifier
            ->shouldReceive('isVerified')
            ->once()
            ->with($data)
            ->andReturn(false);

        $response = $controller->validateUser($request);
        $this->assertTrue($response->isOk());
    }
}

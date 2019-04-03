<?php

declare(strict_types=1);

namespace Tests\Services;

use App\ModelRepositoryInterfaces\ClassInstructorsTableRepositoryInterface;
use App\Models\User;
use App\Services\AuthVerifierService;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class AuthVerifierServiceTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(ClassInstructorsTableRepositoryInterface::class);
    }

    /** @test */
    public function find_returns_true_with_good_creds()
    {
        $this->markTestSkipped('Revisit at later time.');
        $user = new User([
            'user_id' => 'members:1',
            'rank' => 'beast',
        ]);

        $this->be($user);

        Auth::shouldReceive('attempt')
            ->once()
            ->andReturn(true);

        Auth::shouldReceive('user')
            ->andReturn($user);

        $service = new AuthVerifierService($this->retriever);

        $this->retriever
            ->shouldReceive('find')
            ->andReturn(['there is something here']);

        $this->assertTrue($service->isVerified([]));
    }

    /** @test */
    public function find_returns_false_with_bad_creds()
    {
        $this->markTestSkipped('Revisit at later time.');
        $user = new User([
            'user_id' => 'members:1',
            'rank' => 'beast',
        ]);

        $this->be($user);

        Auth::shouldReceive('attempt')
            ->andReturn(true);

        Auth::shouldReceive('user')
            ->andReturn($user);

        Auth::shouldReceive('logout')
            ->andReturn([]);

        $service = new AuthVerifierService($this->retriever);

        $this->retriever
            ->shouldReceive('find')
            ->andReturn(null);

        $this->assertFalse($service->isVerified([]));
    }

    /** @test */
    public function find_returns_false_with_no_user_rank()
    {
        $this->markTestSkipped('Revisit at later time.');
        $user = new User([
            'user_id' => 'members:1',
        ]);

        Auth::shouldReceive('attempt')
            ->andReturn(false);

        $service = new AuthVerifierService($this->retriever);

        $this->assertFalse($service->isVerified([]));
    }
}

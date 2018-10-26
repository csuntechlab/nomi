<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\UserSettingsContract;
use App\Contracts\CacheContract;
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

    public $cacheRetriever;
    public $userSettings;

    /**
     * Description: Sets up the test and ignores Middleware.
     */
    public function setUp()
    {
        parent::setUp();
        $this->disableMiddlewareForAllTests();
        $this->cacheRetriever = Mockery::spy(CacheContract::class);
        $this->userSettings = Mockery::spy(UserSettingsContract::class);
    }

    /** @test */
    public function getData_hits_webservice_if_cache_empty()
    {
        $controller = new SPAController($this->userSettings, $this->cacheRetriever);
        
        $this->cacheRetriever
        ->shouldReceive('cacheCourses')
        ->andReturn([])
        ->once();
        
        $this->cacheRetriever
        ->shouldReceive('cacheStudents')
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
        $controller = new SPAController($this->userSettings, $this->cacheRetriever);
        Cache::forever('courses:default', []);
        Cache::forever('students:0:default', []);

        $this->cacheRetriever
            ->shouldReceive('cacheCourses')
            ->once()
            ->andReturn([]);

        $this->cacheRetriever
            ->shouldReceive('cacheStudents')
            ->once()
            ->andReturn([]);

        Auth::shouldReceive('user')
            ->andReturn($user = Mockery::spy(User::class));

        $user->shouldReceive('email')
            ->andReturn('ThisIsAnEmail');

        $controller->getData();

        Cache::forget('courses:default', []);
        Cache::forget('students:0:default', []);
    }
}

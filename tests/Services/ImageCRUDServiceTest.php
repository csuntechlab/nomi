<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Contracts\UserSettingsContract;
use App\ModelRepositoryInterfaces\UserModelRepositoryInterface;
use App\Models\User;
use App\Services\ImageCRUDService;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Tests\TestCase;

class ImageCRUDServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $userModelRepository = null;
    protected $userSettingsContract = null;
    protected $cache = null;

    public function setUp()
    {
        parent::setUp();
        $this->userModelRepository = Mockery::spy(UserModelRepositoryInterface::class);
        $this->userSettingsContract = Mockery::spy(UserSettingsContract::class);
        $this->cache = Mockery::spy(Repository::class);
    }

    /** @test */
    public function getPriority_returns_everyones_priority()
    {
        $user = new User();
        $user->user_id = 1;
        $this->be($user);

        $imageCRUDService = new ImageCRUDService(
            $this->userModelRepository,
            $this->userSettingsContract,
            $this->cache
        );

        $student_ids = [
            '1',
            '2',
            '3',
        ];

        $this->userModelRepository
            ->shouldReceive('find')
            ->once()
            ->andReturn([
                [
                    'image_priority' => [
                        'image_priority' => 'avatar',
                        'user_id' => 1,
                    ],
                ],
                [
                    'image_priority' => [
                        'image_priority' => 'official',
                        'user_id' => 1,
                    ],
                ],
                [
                    'image_priority' => null,
                ],
            ]);

        $priorities = [
            'avatar',
            'official',
            'avatar',
        ];

        $this->assertEquals($imageCRUDService->getPriority($student_ids), $priorities);
    }
}

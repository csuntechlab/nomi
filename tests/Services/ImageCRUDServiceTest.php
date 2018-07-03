<?php

declare(strict_types=1);

namespace Tests\Services;

use App\ModelRepositoryInterfaces\UserModelRepositoryInterface;
use App\Models\User;
use App\Services\ImageCRUDService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Tests\TestCase;

class ImageCRUDServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected $userModelRepository = null;

    public function setUp()
    {
        parent::setUp();
        $this->userModelRepository = Mockery::spy(UserModelRepositoryInterface::class);
    }

    /** @test */
    public function getPriority_returns_everyones_priority()
    {
        $user = new User(['user_id' => 1]);
        $this->be($user);

        $imageCRUDService = new ImageCRUDService($this->userModelRepository);

        $student_ids = [
            '1',
            '2',
            '3',
        ];

        $this->userModelRepository
            ->shouldReceive('getUsersWithImagePriority')
            ->once()
            ->andReturn([
                [
                    'image_priority' => [
                        'image_priority' => 'likeness',
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
            'likeness',
            'official',
            'likeness',
        ];

        $this->assertEquals($imageCRUDService->getPriority($student_ids), $priorities);
    }
}

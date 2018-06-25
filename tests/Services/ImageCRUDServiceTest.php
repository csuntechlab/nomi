<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Services\ImageCRUDService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ImageCRUDServiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function getPriority_returns_everyones_priority()
    {
        $imageCRUDService = new ImageCRUDService();

        $student_ids = [
            '1',
            '2',
            '3',
        ];

        factory(User::class)->make([
            'user_id' => 'members:1',
            'ImagePriority' => 'likeness',
        ])->save();

        factory(User::class)->make([
            'user_id' => 'members:2',
            'ImagePriority' => 'official',
        ])->save();

        factory(User::class)->make([
            'user_id' => 'members:3',
        ])->save();

        $priorities = [
            'likeness',
            'official',
            'likeness',
        ];

        $this->assertEquals($imageCRUDService->getPriority($student_ids), $priorities);
    }
}

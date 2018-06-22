<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Services\ImageCRUDService;
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
            'one',
            'two',
            'three',
        ];

        $priorities = [
            'likeness',
            'likeness',
            'likeness',
        ];

        $this->assertEquals($imageCRUDService->getPriority($student_ids), $priorities);
    }
}

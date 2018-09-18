<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Services\UploadPermissionService;
use Mockery;
use Tests\TestCase;

class UploadPermissionServiceTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(UploadPermissionContract::class);
    }

    /** @test */
    public function getUploadPermission_returns_an_image_and_id()
    {
        $facultyService = new UploadPermissionService($this->retriever);

        $this->retriever
            ->shouldReceive('getUploadPermission')
            ->withArgs(['MrTeacherMan@gmail.com'])
            ->andReturn(\json_encode(['people' => [
                'profile_image' => 'thisIsAnImage',
                'individuals_id' => 'thisIsAnId',
            ],
        ]));

        $returnArray = [
            'image' => 'thisIsAnImage',
            'id' => 'thisIsAnId',
        ];

        $output = $facultyService->getUploadPermission('MrTeacherMan@gmail.com');

        $this->assertEquals($output, $returnArray);
    }
}

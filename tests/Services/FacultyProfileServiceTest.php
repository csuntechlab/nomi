<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Contracts\WebResourceRetrieverContract;
use App\Services\FacultyProfileService;
use Mockery;
use Tests\TestCase;

class FacultyProfileServiceTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(WebResourceRetrieverContract::class);
    }

    /** @test */
    public function getFacultyProfile_returns_an_image_and_id()
    {
        $facultyService = new FacultyProfileService($this->retriever);

        $this->retriever
            ->shouldReceive('getStudent')
            ->withArgs(['MrTeacherMan@gmail.com'])
            ->andReturn(\json_encode(['people' => [
                'profile_image' => 'thisIsAnImage',
                'individuals_id' => 'memthisIsAnId',
            ],
        ]));

        $returnArray = [
            'image' => 'thisIsAnImage',
            'id' => 'thisIsAnId',
        ];

        $output = $facultyService->getFacultyProfile('MrTeacherMan@gmail.com');

        $this->assertEquals($output, $returnArray);
    }
}

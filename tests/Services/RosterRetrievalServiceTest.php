<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\ImageCRUDContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Services\RosterRetrievalService;
use Mockery;
use Tests\TestCase;

class RosterRetrievalServiceTest extends TestCase
{
    public $retriever;
    public $imageCRUD;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(WebResourceRetrieverContract::class);
        $this->imageCRUD = Mockery::spy(ImageCRUDContract::class);
    }

    /** @test */
    public function processMembers_works()
    {
        $this->imageCRUD
            ->shouldReceive('getPriority')
            ->withArgs([1, 3])
            ->andReturn(['likeness', 'official']);

        $rosterService = new RosterRetrievalService($this->retriever, $this->imageCRUD);

        $images = [
            'likeness' => 'http://localhost/images/likeness.jpg',
            'avatar' => 'images/student_avatar_default.jpg',
            'official' => 'images/student_profile_default.jpg',
        ];

        $paulBlart = new \stdClass();
        $paulBlart->position = 'Mall Cop';
        $paulBlart->members_id = 1;
        $paulBlart->first_name = 'Paul';
        $paulBlart->last_name = 'Blart';
        $paulBlart->email = 'cop@mall.com';
        $paulBlart->images = $images;
        $paulBlart->image_priority = 'likeness';

        $shrek = new \stdClass();
        $shrek->position = 'Instructor';
        $shrek->members_id = 2;
        $shrek->first_name = 'Shrek';
        $shrek->last_name = 'Nelson';
        $shrek->email = 'ogre@swamp.com';
        $shrek->images = $images;
        $shrek->image_priority = 'likeness';

        $bigJim = new \stdClass();
        $bigJim->position = 'Student';
        $bigJim->members_id = 3;
        $bigJim->first_name = 'Big';
        $bigJim->last_name = 'Jim';
        $bigJim->email = 'mountainman@parks.gov';
        $bigJim->images = $images;
        $bigJim->image_priority = 'official';

        $roster = [$paulBlart, $shrek, $bigJim];

        $cleanRoster = [
            [
                'student_id' => 1,
                'first_name' => 'Paul',
                'last_name' => 'Blart',
                'email' => 'cop@mall.com',
                'images' => $images,
                'image_priority' => 'likeness',
                'recognized' => false,
            ],

            [
                'student_id' => 3,
                'first_name' => 'Big',
                'last_name' => 'Jim',
                'email' => 'mountainman@parks.gov',
                'images' => $images,
                'image_priority' => 'official',
                'recognized' => false,
            ],
        ];

        $this->assertEquals($rosterService->processMembers($roster), $cleanRoster);
    }

    /** @test */
    public function sanitizeStudent_works()
    {
        $rosterService = new RosterRetrievalService($this->retriever, $this->imageCRUD);
        $student = new \stdClass();
        $student->members_id = 0;
        $student->first_name = 'John';
        $student->last_name = 'Connor';
        $student->email = 'john.connor.123@my.csun.edu';
        $student->image_priority = 'avatar';

        $recognized = false;

        $images = [
            'likeness' => 'http://localhost/images/likeness.jpg',
            'avatar' => 'images/student_avatar_default.jpg',
            'official' => 'images/student_profile_default.jpg',
        ];

        $this->assertEquals(
            $rosterService->sanitizeStudent($student),
            [
                'student_id' => $student->members_id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'email' => $student->email,
                'images' => $images,
                'image_priority' => $student->image_priority,
                'recognized' => $recognized,
            ]
        );
    }
}

<?php

declare(strict_types=1);

namespace Tests\Services;

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
        // $this->markTestIncomplete();
        $this->imageCRUD
            ->shouldReceive('getPriority')
            ->once()
            ->andReturn(['likeness', 'official']);

        $rosterService = new RosterRetrievalService($this->retriever, $this->imageCRUD);

        $paulBlart = new \stdClass();
        $paulBlart->position = 'Mall Cop';
        $paulBlart->members_id = 1;
        $paulBlart->first_name = 'Paul';
        $paulBlart->last_name = 'Blart';
        $paulBlart->email = 'cop@mall.com';
        $paulBlart->email_uri = 'cop';
        $paulBlart->image_priority = 'likeness';

        $shrek = new \stdClass();
        $shrek->position = 'Instructor';
        $shrek->members_id = 2;
        $shrek->first_name = 'Shrek';
        $shrek->last_name = 'Nelson';
        $shrek->email = 'ogre@swamp.com';
        $shrek->email_uri = 'ogre';
        $shrek->image_priority = 'likeness';

        $bigJim = new \stdClass();
        $bigJim->position = 'Student';
        $bigJim->members_id = 3;
        $bigJim->first_name = 'Big';
        $bigJim->last_name = 'Jim';
        $bigJim->email = 'mountainman@parks.gov';
        $bigJim->email_uri = 'mountainman';
        $bigJim->image_priority = 'official';

        $frank = new \stdClass();
        $frank->position = 'Student';
        $frank->members_id = 4;
        $frank->first_name = 'Frank';
        $frank->last_name = 'Tank';
        $frank->email = 'mountainman@parks.gov';
        $frank->email_uri = 'mountainman';
        $frank->image_priority = null;

        $roster = [$paulBlart, $shrek, $bigJim, $frank];

        $this->retriever
            ->shouldReceive('gatherImageCorrectly')
            ->andReturn([
                'likeness' => 'http://localhost/images/likeness.jpg',
                'avatar' => 'images/student_avatar_default.jpg',
            ]);

        $cleanRoster = [
            [
                'student_id' => 3,
                'first_name' => 'Big',
                'last_name' => 'Jim',
                'email' => 'mountainman@parks.gov',
                'email_uri' => 'mountainman',
                'image_priority' => 'official',
                'timestamp' => '&?',
            ],

            [
                'student_id' => 4,
                'first_name' => 'Frank',
                'last_name' => 'Tank',
                'email' => 'mountainman@parks.gov',
                'email_uri' => 'mountainman',
                'image_priority' => 'likeness',
                'timestamp' => '&?',
            ],

            [
                'student_id' => 1,
                'first_name' => 'Paul',
                'last_name' => 'Blart',
                'email' => 'cop@mall.com',
                'email_uri' => 'cop',
                'image_priority' => 'likeness',
                'timestamp' => '&?',
            ],
        ];

        $this->assertEquals($rosterService->processMembers($roster), $cleanRoster);
    }

    /** @test */
    public function sanitizeStudent_works()
    {
        // $this->markTestIncomplete();
        $rosterService = new RosterRetrievalService($this->retriever, $this->imageCRUD);
        $student = new \stdClass();
        $student->members_id = 0;
        $student->first_name = 'John';
        $student->last_name = 'Connor';
        $student->email = 'john.connor.123@my.csun.edu';
        $student->email_uri = 'john.connor.123';
        $student->image_priority = 'avatar';

        $this->assertEquals(
            $rosterService->sanitizeStudent($student),
            [
                'student_id' => $student->members_id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'email' => $student->email,
                'email_uri' => $student->email_uri,
                'image_priority' => $student->image_priority,
                'timestamp' => '&?',
            ]
        );
    }
}

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
            'avatar' => 'http://localhost/images/student_avatar_default.jpg',
            'official' => 'http://localhost/images/student_profile_default.jpg',
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

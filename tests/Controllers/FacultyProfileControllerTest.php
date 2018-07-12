<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\FacultyProfileContract;
use App\Http\Controllers\FacultyProfileController;
use Mockery;
use Tests\TestCase;

class FacultyProfileControllerTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(FacultyProfileContract::class);
    }

    /**
     * @test
     */
    public function getFacultyProfile_gets_faculty_profile_from_retriever()
    {
        $controller = new FacultyProfileController($this->retriever);

        $this->retriever
            ->shouldReceive('getFacultyProfile')
            ->once();

        $controller->getFacultyProfile('hehe');
    }
}

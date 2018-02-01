<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\ImageCRUDContract;
use App\Http\Controllers\ImageController;
use Mockery;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    public $retriever;

    /**
     * Description: Sets up the test and makes a mock of
     *              ImageCRUDContract.
     */
    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(ImageCRUDContract::class);
    }

    /**
     * @test
     */
    public function getCourses_calls_courses_in_retriever()
    {
        $controller = new ImageController($this->retriever);

        $this->retriever
            ->shouldReceive('upload')
            ->once();

        $controller->uploadImage();
    }
}

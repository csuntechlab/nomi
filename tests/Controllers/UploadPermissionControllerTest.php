<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\UploadPermissionContract;
use App\Http\Controllers\UploadPermissionController;
use Mockery;
use Tests\TestCase;

class UploadPermissionControllerTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(UploadPermissionContract::class);
    }

    /**
     * @test
     */
    public function getUploadPermission_get_upload_permission_from_retriever()
    {
        $controller = new UploadPermissionController($this->retriever);

        $this->retriever
            ->shouldReceive('getUploadPermission')
            ->once();

        $controller->getUploadPermission('hehe');
    }

    /**
     * @test
     */
    public function storePermission_store_permission_from_retriever()
    {
        ///
    }
}

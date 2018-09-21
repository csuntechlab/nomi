<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Contracts\UploadPermissionContract;
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
    public function getUploadPermission_returns_indication_that_faculty_gave_permission()
    {
        $UploadPermissionService = new UploadPermissionService($this->retriever);

        $this->retriever
            ->shouldReceive('getUploadPermission')
            ->andReturn(
                \json_encode(['permission' => false])
        );
    }

    /** @test */
    public function storeUploadPermission_stores_permission()
    {
        $UploadPermissionService = new UploadPermissionService($this->retriever);
    }
}

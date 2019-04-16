<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Models\UploadPermission;
use App\Models\User;
use App\Services\UploadPermissionService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UploadPermissionServiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function getUploadPermission_returns_true_when_faculty_gave_permission()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $uploadPermissionService = new UploadPermissionService();

        $uploadPermission = factory(UploadPermission::class)->make([
            'user_id' => 'members:professor',
        ])->save();

        $output = $uploadPermissionService->getUploadPermission();

        $this->assertEquals(\json_encode(['permission' => true]), $output);
    }

    /** @test */
    public function getUploadPermission_returns_false_when_faculty_has_not_given_permission()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $uploadPermissionService = new UploadPermissionService();

        $output = $uploadPermissionService->getUploadPermission();

        $this->assertEquals(\json_encode(['permission' => false]), $output);
    }

    /** @test */
    public function storeUploadPermission_stores_user_id()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $uploadPermissionService = new UploadPermissionService();

        $uploadPermissionService->storePermission();

        $this->assertDatabaseHas('upload_permissions', [
            'user_id' => $user['user_id'],
            ]);
    }
}

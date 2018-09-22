<?php

declare(strict_types=1);

namespace Tests\Services;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UploadPermissionServiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function getUploadPermission_returns_true_when_faculty_gave_permission()
    {
    }

    /** @test */
    public function getUploadPermission_returns_false_when_faculty_has_not_given_permission()
    {
    }

    /** @test */
    public function storeUploadPermission_stores_permission()
    {
    }
}

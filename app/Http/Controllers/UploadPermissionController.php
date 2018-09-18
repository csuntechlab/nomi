<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UploadPermissionContract;

class UploadPermissionController extends Controller
{
    protected $uploadPermissionContract;

    public function __construct(UploadPermissionContract $uploadPermissionContract)
    {
        $this->uploadPermissionContract = $uploadPermissionContract;
    }

    public function getUploadPermission()
    {
        return $this->uploadPermissionContract->getUploadPermission();
    }

    public function storePermission()
    {
        return $this->uploadPermissionContract->storePermission();
    }
}

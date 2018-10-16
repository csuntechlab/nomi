<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UploadPermissionContract;

class UploadPermissionController extends Controller
{
    protected $uploadPermissionUtility;

    public function __construct(UploadPermissionContract $uploadPermissionUtility)
    {
        $this->uploadPermissionUtility = $uploadPermissionUtility;
    }

    public function getUploadPermission()
    {
        return $this->uploadPermissionUtility->getUploadPermission();
    }

    public function storePermission()
    {
        return $this->uploadPermissionUtility->storePermission();
    }
}

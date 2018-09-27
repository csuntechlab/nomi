<?php

declare(strict_types=1);

namespace App\Contracts;

interface UploadPermissionContract
{
    public function getUploadPermission(): String;

    public function storePermission();
}

<?php

declare(strict_types=1);

namespace App\Contracts;

interface UploadPermissionContract
{
    public function getUploadPermission();

    public function storePermission();
}

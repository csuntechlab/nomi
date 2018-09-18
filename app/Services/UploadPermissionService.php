<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UploadPermissionContract;
use App\Models\UploadPermission;

class UploadPermissionService implements UploadPermissionContract
{
    public function getUploadPermission()
    {
        $permission = UploadPermission::where('user_id', auth()->user()->user_id)->first();
        $hasPermission = false;

        if ($permission !== null) {
            $hasPermission = true;
        }

        return \json_encode(['permission' => $hasPermission]);
    }

    public function storePermission()
    {
        $permission = new UploadPermission();
        $permission->user_id = auth()->user()->user_id;
        $permission->save();
    }
}

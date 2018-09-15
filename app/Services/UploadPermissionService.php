<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UploadPermissionContract;

class UploadPermissionService implements UploadPermissionContract
{
    public function getUploadPermission($user_id)
    {
        if ($user != null) {
            return true;
        }

        return false;
    }

    public function updateUploadPermission($data)
    {
        User::new(
            ['user_id' => auth()->user()->user_id, 'individuals_id' => $data['individuals_id']]
        );

        return 'Posted';
    }
}

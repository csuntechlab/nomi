<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class UploadPermissionController extends Controller
{
    protected $uploadPermissionContract;

    public function __construct(UploadPermissionContract $uploadPermissionContract)
    {
        $this->uploadPermissionContract = $uploadPermissionContract;
    }

    public function getUploadPermission($user_id)
    {
        return $this->uploadPermissionContract->getUploadPermission($user_id);
    }

    public function updateUploadPermission(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
        ];

        return $this->uploadPermissionContract->updateUploadPermission($data);
    }
}

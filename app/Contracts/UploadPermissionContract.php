<?php

declare(strict_types=1);

namespace App\Contracts;

interface StudentProfileContract
{
    public function getUploadPermission($user_id);

    public function updateUploadPermission($data);
}

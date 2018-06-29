<?php

declare(strict_types=1);

namespace App\ModelRepositories;

use App\ModelRepositoryInterfaces\UserModelRepositoryInterface;
use App\Models\User;

class UserModelRepository implements UserModelRepositoryInterface
{
    public function getUsersWithImagePriority(array $userIds): array
    {
        return User::with('ImagePriority')
        ->whereIn('user_id', $userIds)
        ->get()->toArray();
    }
}

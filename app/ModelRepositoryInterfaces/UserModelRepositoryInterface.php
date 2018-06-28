<?php

declare(strict_types=1);

namespace App\ModelRepositoryInterfaces;

interface UserModelRepositoryInterface
{
    public function getUsersWithImagePriority(array $userIds): array;
}

<?php

declare(strict_types=1);

namespace App\ModelRepositoryInterfaces;

interface UserModelRepositoryInterface
{
    public function find(array $userIds): array;
    public function all(): array;
}

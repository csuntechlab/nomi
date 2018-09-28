<?php

declare(strict_types=1);

namespace App\ModelRepositoryInterfaces;

interface TermModelRepositoryInterface
{
    public function find($today): array;
    public function all(): array;
}

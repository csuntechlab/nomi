<?php

declare(strict_types=1);

namespace App\ModelRepositories;

use App\ModelRepositoryInterfaces\TermModelRepositoryInterface;
use App\Models\Term;

class TermModelRepository implements TermModelRepositoryInterface
{
    public function find($today): array
    {
        return Term::currentTerm($today)
        ->first()
        ->toArray();
    }

    public function all(): array
    {
        return Term::all()
        ->toArray();
    }
}

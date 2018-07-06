<?php

declare(strict_types=1);

namespace App\ModelRepositories;

use App\ModelRepositoryInterfaces\TermModelRepositoryInterface;
use App\Models\Term;

class TermModelRepository implements TermModelRepositoryInterface
{
    public function getCurrentTerm($today): array
    {
        return Term::where('begin_date', '<=', $today)
                    ->where('end_date', '>=', $today)
                    ->first()
                    ->toArray();
    }
}

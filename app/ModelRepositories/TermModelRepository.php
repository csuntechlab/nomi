<?php

declare(strict_types=1);

namespace App\ModelRepositories;

use App\ModelRepositoryInterfaces\TermModelRepositoryInterface;
use App\Models\Term;
use Carbon\Carbon;

class TermModelRepository implements TermModelRepositoryInterface
{
    public function find($today): array
    {
        $terms = Term::nowAndNextTerm(1)->get();
        $currentTerm = $terms->first();
        $nextTerm = $terms->last();

        $today = Carbon::today();
        $nextStart = Carbon::parse($nextTerm->begin_date);
        $diff = $today->diffInDays($nextStart);

        // is next term 3 weeks away
        if ($diff >= 0 && $diff <= 21) {
            return $nextTerm->toArray();
        }

        return $currentTerm->toArray();
    }

    public function all(): array
    {
        return Term::all()
        ->toArray();
    }
}

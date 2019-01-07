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
        $currentTerm = Term::currentTerm($today)
        ->first();

        while ($currentTerm == null) {
            $today = Carbon::parse($today)->addWeeks(1)->toDateTimeString();
            $currentTerm = Term::currentTerm($today)
          ->first();
        }

        return $currentTerm->toArray();
    }

    public function all(): array
    {
        return Term::all()
        ->toArray();
    }
}

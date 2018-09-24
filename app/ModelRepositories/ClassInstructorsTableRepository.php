<?php

declare(strict_types=1);

namespace App\ModelRepositories;

use App\ModelRepositoryInterfaces\ClassInstructorsTableRepositoryInterface;
use App\Models\ClassInstructors;
use Illuminate\Support\Facades\DB;

// Currently is tightly coupled to the Model
class ClassInstructorsTableRepository implements ClassInstructorsTableRepositoryInterface
{
    public function find($userId)
    {
        return ClassInstructors::userId($userId)
        ->first();
    }

    public function all()
    {
        return ClassInstructors::all();
    }


}

<?php

declare(strict_types=1);

namespace App\ModelRepositories;

use App\ModelRepositoryInterfaces\ClassInstructorsTableRepositoryInterface;
use App\Models\ClassInstructors;
use Illuminate\Support\Facades\DB;

class ClassInstructorsTableRepository implements ClassInstructorsTableRepositoryInterface
{
    public function verifyUserWasAtOnePointAClassInstructor($userId)
    {
        return DB::table('class_instructors')
        ->where('user_id', $userId)
        ->first();
    }

    public function find($userId)
    {
        return ClassInstructors::userId($userId)
        ->first();
    }

    public function save(ClassInstructor $classInstructor)
    {
        $classInstructor->save();
    }

    public function all()
    {
        return ClassInstructors::all();
    }


}

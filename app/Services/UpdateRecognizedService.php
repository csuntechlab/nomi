<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\UpdateRecognizedContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UpdateRecognizedService implements UpdateRecognizedContract
{
    public function markAsRecognized()
    {
        $student_id = request()->student_id;
        $professor_id = Auth::user()->user_id;
        DB::table('recognitions')->insert([
            'professor_id' => $professor_id,
            'student_id' => $student_id,
        ]);

        Cache::forget('students');
    }

    public function markAsUnrecognized()
    {
        $student_id = request()->student_id;
        $professor_id = Auth::user()->user_id;
        DB::table('recognitions')
            ->where('professor_id', $professor_id)
            ->where('student_id', $student_id)
            ->delete();

        Cache::forget('students');
    }
}

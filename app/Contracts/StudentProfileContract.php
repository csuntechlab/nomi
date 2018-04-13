<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Http\Request;

interface StudentProfileContract
{
    public function getStudentProfile($email);

    public function updateStudentNotes(Request $request);
}

<?php

declare(strict_types=1);

namespace App\Contracts;

interface StudentProfileContract
{
    public function getStudentProfile($email);

    public function updateStudentNotes($data);

    public function getStudentWithNoEmail($data);
}

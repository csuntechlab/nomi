<?php

declare(strict_types=1);

namespace App\Contracts;

interface RosterRetrievalContract
{
    public function getStudentsFromRoster($term, $course);

    public function sanitizeStudent($student, $imageManager = null);
}

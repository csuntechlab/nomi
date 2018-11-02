<?php

declare(strict_types=1);

namespace App\Contracts;

interface CacheContract
{
    // Description: A contract for abstracting cache functionality.
    public function cacheCourses($id, $term, $minutes);

    public function cacheStudents($students, $courses, $len, $id, $term, $minutes);
}

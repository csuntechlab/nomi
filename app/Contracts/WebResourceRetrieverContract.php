<?php

declare(strict_types=1);

namespace App\Contracts;

interface WebResourceRetrieverContract
{
    public function getCourses($term);

    public function getRoster($term, $course);

    public function getMedia();
}

<?php

declare(strict_types=1);

namespace App\Contracts;

interface WebResourceRetrieverContract
{
    public function getCourses();

    public function getRoster();

    public function getMedia();
}

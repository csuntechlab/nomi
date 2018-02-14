<?php

declare(strict_types=1);

namespace App\Contracts;

interface UpdateRecognizedContract
{
    public function markAsRecognized();

    public function markAsUnrecognized();
}

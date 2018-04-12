<?php

declare(strict_types=1);

namespace App\Contracts;

interface ImageCRUDContract
{
    public function upload();

    public function updatePriority();

    public function getPriority($student_ids);
}

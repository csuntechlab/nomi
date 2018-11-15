<?php

declare(strict_types=1);

namespace App\Contracts;

interface ImageCRUDContract
{
    public function upload($data);

    public function updatePriority($data);

    public function getPriority($student_ids);
}

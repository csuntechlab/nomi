<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\CurriculumRetrieverContract;

class CurriculumController extends Controller
{
    private $curriculumRetriever;

    public function __construct(CurriculumRetrieverContract $curriculumRetriever)
    {
        $this->curriculumRetriever = $curriculumRetriever;
    }

    public function getCourses()
    {
        return $this->curriculumRetriever->getCourses();
    }
}

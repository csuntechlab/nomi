<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CanvasContract;
use App\Contracts\WebResourceRetrieverContract;


/**
 * Intervention implementation of image CRUD.
 */
class CanvasService implements CanvasContract
{
    protected $webResourceUtility = null;


    public function __construct(
        WebResourceRetrieverContract $webResourceUtility
    ) {
        $this->webResourceUtility = $webResourceUtility;
    }

    public function getCanvasCourses($id) {
        $course_data = $this->webResourceUtility->getCoursesFromCanvas($id);
        dd($course_data);
    }

}

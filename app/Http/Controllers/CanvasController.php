<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\CanvasContract;


class CanvasController extends Controller
{
    protected $canvasContract;

    public function __construct(CanvasContract $canvasContract)
    {
        $this->canvasContract = $canvasContract;
    }

    public function getCanvasCourses()
    {
        return $this->canvasContract->getCanvasCourses();
    }
}
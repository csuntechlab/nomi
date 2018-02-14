<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UpdateRecognizedContract;

class RecognizedController extends Controller
{
    protected $recognizedContract = null;

    public function __construct(UpdateRecognizedContract $recognizedContract)
    {
        $this->recognizedContract = $recognizedContract;
    }

    public function markAsRecognized()
    {
        $this->recognizedContract->markAsRecognized();
    }

    public function markAsUnrecognized()
    {
        $this->recognizedContract->markAsUnrecognized();
    }
}

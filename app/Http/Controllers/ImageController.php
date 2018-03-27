<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\ImageCRUDContract;

class ImageController extends Controller
{
    public $imageCRUDContract;

    /**
     * ImageController constructor.
     *
     * @param ImageCRUDContract $imageCRUDContract
     */
    public function __construct(ImageCRUDContract $imageCRUDContract)
    {
        $this->imageCRUDContract = $imageCRUDContract;
    }

    public function uploadImage()
    {
        return $this->imageCRUDContract->upload();
    }

    public function updatePriority()
    {
        return $this->imageCRUDContract->updatePriority();
    }
}

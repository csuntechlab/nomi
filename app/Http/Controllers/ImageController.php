<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\ImageCRUDContract;
use Illuminate\Http\Request;

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

    public function uploadImage(Request $request)
    {
        $data = [
            'id' => $request->id,
            'profile_image' => $request->profile_image,
            'image_type' => $request->image_type,
            'entity_type' => $request->entity_type,
            'uri' => $request->uri,
        ];

        return $this->imageCRUDContract->upload($data);
    }

    public function updatePriority(Request $request)
    {
        return $this->imageCRUDContract->updatePriority($request);
    }

    public function getPriority($student_id)
    {
        return $this->imageCRUDContract->getPriority($student_id);
    }
}

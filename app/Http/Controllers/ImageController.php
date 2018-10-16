<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\ImageCRUDContract;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public $imageCRUDUtility;

    /**
     * ImageController constructor.
     *
     * @param ImageCrudContract $imageCRUDUtility
     */
    public function __construct(ImageCRUDContract $imageCRUDUtility)
    {
        $this->imageCRUDUtility = $imageCRUDUtility;
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

        return $this->imageCRUDUtility->upload($data);
    }

    public function updatePriority(Request $request)
    {
        return $this->imageCRUDUtility->updatePriority($request);
    }

    public function getPriority($student_id)
    {
        return $this->imageCRUDUtility->getPriority($student_id);
    }
}

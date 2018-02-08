<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

/**
 * Intervention implementation of image CRUD.
 */
class ImageCRUDService implements ImageCRUDContract
{
    /**
     * Image uploading functionality.
     */
    public function upload()
    {
        $image = request()->media;

        $data = [
            'image' => $image,
        ];

        $rules = [
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return 'Failed';
        }

        $image->move(
            env('IMAGE_UPLOAD_LOCATION'),
            $image->getClientOriginalName()
        );

        Cache::forget('students');

        return 'Uploaded';
    }
}

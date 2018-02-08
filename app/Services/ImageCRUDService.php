<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
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
        $email = \str_replace('nr_', '', request()->email);
        $email = \substr($email, 0, \strpos($email, '@'));

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
            env('IMAGE_UPLOAD_LOCATION') . '/' . $email . '/',
            'avatar.jpg'
        );

        return 'Uploaded';
    }
}

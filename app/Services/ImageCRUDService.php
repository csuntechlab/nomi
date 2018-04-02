<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;

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
        $manager = new ImageManager();
        $image = $manager->make(request()->media);
        $email = \str_replace('nr_', '', request()->email);
        $email = \explode('@', $email)[0];

        ////        $data = [
        ////            'image' => $image,
        ////        ];
        ////
        ////        $rules = [
        ////            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
        ////        ];
        ////
        ////        $validator = Validator::make($data, $rules);
//
//        if ($validator->fails()) {
//            return 'Failed';
//        }

        $image->save(env('IMAGE_UPLOAD_LOCATION') . '/' . $email . '/avatar.jpg');

        Cache::forget('students');

        return 'Uploaded';
    }
}

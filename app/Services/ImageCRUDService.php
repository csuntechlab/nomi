<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;

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
        $image = request()->file('image');
        $data = [
            'image' => $image,
        ];

        $rules = [
            'image' => 'required|mimes:jpeg,jpg,png|max:1000',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->route('/')->withErrors($validator);
        }

        //$destinationPath = env("IMAGE_UPLOAD_LOCATION");
        $destinationPath = '/resources';

        Input::file('image')->move($destinationPath, 'test_img');

        return redirect(route('/'));
    }
}

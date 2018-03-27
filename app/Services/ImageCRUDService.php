<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\ImagePriority;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

/**
 * Intervention implementation of image CRUD.
 */
class ImageCRUDService implements ImageCRUDContract
{
    /** Image uploading functionality. */
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

        $image->move(env('IMAGE_UPLOAD_LOCATION') . '/' . $email . '/', 'avatar.jpg');

        for ($i = 0; $i < 10; ++$i) {
            Cache::forget('students_' . $i);
        }

        return 'Uploaded';
    }

    /** Update image_priority table */
    public function updatePriority()
    {
        $user = User::with('ImagePriority')
            ->where('user_id', 'members:' . request()->student_id)
            ->firstOrFail();

        if (null !== $user->imagePriority) {
            $user->imagePriority->image_priority = request()->image_priority;
            $user->imagePriority->save();
        } else {
            $user->imagePriority()->create(['image_priority' => request()->image_priority]);
        }

        for ($i = 0; $i < 10; ++$i) {
            Cache::forget('students_' . $i);
        }

        return "Completed.\n";
    }
}

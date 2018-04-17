<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Models\ImagePriority;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

/**
 * Intervention implementation of image CRUD.
 */
class ImageCRUDService implements ImageCRUDContract
{
    /** Image uploading functionality. */
    public function upload()
    {
        $manager = new ImageManager(['driver' => 'imagick']);

        $image = $manager->make(request()->media);
        $email = \str_replace('nr_', '', request()->email);
        $uri = \explode('@', $email)[0];

        $oldmask = \umask(0);

        if (!File::exists(env('IMAGE_UPLOAD_LOCATION') . $uri)) {
            File::makeDirectory(env('IMAGE_UPLOAD_LOCATION') . $uri, 0777);
        }

        $image->save(env('IMAGE_UPLOAD_LOCATION') . $uri . '/likeness.jpg');

        \umask($oldmask);

        for ($i = 0; $i < 10; ++$i) {
            Cache::forget('students_' . $i);
        }

        return 'Uploaded';
    }

    /** Retrieve image priority
     * @param $student_ids
     *
     * @return array
     */
    public function getPriority($student_ids)
    {
        $array = [];
        $out = [];

        foreach ($student_ids as $student_id) {
            \array_push($array, 'members:' . $student_id);
        }

        $users = User::with('ImagePriority')
            ->whereIn('user_id', $array)
            ->get();

        foreach ($users as $user) {
            if (null !== $user->imagePriority) {
                \array_push($out, $user->imagePriority->image_priority);
            } else {
                \array_push($out, 'likeness');
            }
        }

        for ($i = 0; $i < 10; ++$i) {
            Cache::forget('students_' . $i);
        }

        return $out;
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

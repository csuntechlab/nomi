<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Models\ImagePriority;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManager;

/**
 * Intervention implementation of image CRUD.
 */
class ImageCRUDService implements ImageCRUDContract
{
    /** Image uploading functionality. */
    public function upload()
    {
        $manager = new ImageManager();

        $image = $manager->make(request()->media);
        $email = \str_replace('nr_', '', request()->email);
        $email = \explode('@', $email)[0];

        $image->save(env('IMAGE_UPLOAD_LOCATION') . '/' . $email . '/likeness.jpg');

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

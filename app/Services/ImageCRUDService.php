<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\ModelRepositoryInterfaces\UserModelRepositoryInterface;
use App\Models\ImagePriority;
use CSUNMetaLab\Guzzle\Factories\HandlerGuzzleFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

/**
 * Intervention implementation of image CRUD.
 */
class ImageCRUDService implements ImageCRUDContract
{
    protected $userModelUtility = null;

    public function __construct(UserModelRepositoryInterface $userModelUtility)
    {
        $this->userModelUtility = $userModelUtility;
    }

    /** Image uploading functionality. */
    public function upload($data)
    {
        $validator = Validator::make(
            $data,
            [
                'profile_image' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (!\base64_decode($value)) {
                            return $fail('Please include ' . $attribute . ' it is required.');
                        }
                    }, ],
                'entity_type' => 'required|string',
                'image_type' => 'required|string',
            ]
        );
        if ($validator->fails()) {
            return [
                'status' => '422',
                'success' => 'false',
                'message' => $validator->messages()->all(),
            ];
        }
        if ($data['profile_image']) {
            $guzzle = HandlerGuzzleFactory::fromDefaults();
            $guzzle->setFormBody([
                'profile_image' => $data['profile_image'],
                'image_type' => $data['image_type'],
                'entity_type' => $data['entity_type'],
                'secret_key' => env('MEDIA_KEY'),
            ]);

            $response = $guzzle->post(env('MEDIA_URL') . $data['uri'] . '/photo');
            $guzzleResponse = $guzzle->resolveResponseBody($response, 'json');
            if ($guzzleResponse->status === '200') {
                return [
                    'status' => '200',
                    'success' => 'true',
                    'message' => 'The image for ' . $data['uri'] . ' was successfully uploaded.',
                ];
            }

            return [
                    'status' => '400',
                    'success' => 'false',
                    'message' => 'An error occurred, please try again.',
                ];
        }
    }

    /** Retrieve image priority
     * @param $student_ids
     *
     * @return array
     */
    public function getPriority($student_ids)
    {
        $out = [];
        if (\count($student_ids) > 1) {
            $array = [];
            foreach ($student_ids as $student_id) {
                \array_push($array, 'members:' . $student_id);
            }

            $users = $this->userModelUtility->find($array);

            foreach ($users as $user) {
                if ($user['image_priority'] && $user['image_priority']['user_id'] == auth()->user()->user_id) {
                    \array_push($out, $user['image_priority']['image_priority']);
                } else {
                    \array_push($out, 'likeness');
                }
            }
        } else {
            $student_ids[0] = 'members:' . $student_ids[0];

            $user = $this->userModelUtility->find($student_ids);

            if (\count($user) === 0) {
                \array_push($out, 'likeness');
            } else {
                $user = $user[0];
                if ($user['image_priority'] && $user['image_priority']['user_id'] == auth()->user()->user_id) {
                    \array_push($out, $user['image_priority']['image_priority']);
                } else {
                    \array_push($out, 'likeness');
                }
            }
        }

        return $out;
    }

    /** Update image_priority table */
    public function updatePriority()
    {
        $facultyID = request()->faculty_id;
        $priority = ImagePriority::updateOrCreate(
            ['user_id' => $facultyID, 'student_id' => request()->student_id],
            ['image_priority' => request()->image_priority]
        );
        $this->clearCache($facultyID);
    }

    private function clearCache($facultyID)
    {
        $msg = $facultyID;
        for ($i = 0; $i < 10; ++$i) {
            if (Cache::has('students:' . $i . ':' . $facultyID)) {
                Cache::forget('students:' . $i . ':' . $facultyID);
                $msg .= "forgot students\n";
            }
            if (Cache::has('courses:' . $facultyID)) {
                Cache::forget('courses:' . $facultyID);
                $msg .= "forgot courses\n\n";
            }
        }

        return $msg;
    }
}

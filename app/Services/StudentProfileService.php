<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\StudentProfileContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Models\Note;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class StudentProfileService implements StudentProfileContract
{
    protected $webResourceRetriever = null;

    public function __construct(WebResourceRetrieverContract $webResourceRetriever)
    {
        $this->webResourceRetriever = $webResourceRetriever;
    }

    public function getStudentProfile($email)
    {
        $student = $this->webResourceRetriever->getStudent($email);
        $imageManager = new ImageManager(['driver' => 'imagick']);

        $profile = \json_decode($student, true)['people'];

        if ($profile['profile_image'] == null) {
            $profile['profile_image'] = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_profile_default.jpg')
                ->encode('data-url');
        }

        $note = Note::where('user_id', auth()->user()->user_id)
            ->where('student_id', $profile['individuals_id'])
            ->first();

        if ($note == null) {
            $notes = 'Notes go here.';
        } else {
            $notes = $note->notepad;
        }

        $studentProfile = [
            'display_name' => $profile['display_name'],
            'email' => $profile['email'],
            'image' => $profile['profile_image'],
            'notes' => $notes,
        ];

        return $studentProfile;
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\StudentProfileContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Models\Note;
use Illuminate\Http\Request;
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
        $imageManager = new ImageManager(['driver' => 'imagick']);
        $profile = \json_decode($this->webResourceRetriever->getStudent($email), true)['people'];

        if ($profile['profile_image'] == null) {
            $profile['profile_image'] = (string) $imageManager
                ->make(env('IMAGE_UPLOAD_LOCATION') . '/student_profile_default.jpg')
                ->encode('data-url');
        }

        $note = Note::where('user_id', auth()->user()->user_id)
            ->where('student_id', $profile['individuals_id'])
            ->first();

        $studentProfile = [
            'display_name' => $profile['display_name'],
            'email' => $profile['email'],
            'image' => $profile['profile_image'],
            'student_id' => $profile['individuals_id'],
            'notes' => $note == null ? 'Notes go here.' : $note->notepad,
        ];

        return $studentProfile;
    }

    public function updateStudentNotes(Request $request)
    {
        $note = Note::updateOrCreate(
            ['user_id' => auth()->user()->user_id, 'student_id' => $request->student_id],
            ['notepad' => $request->notepad]
        );
    }
}

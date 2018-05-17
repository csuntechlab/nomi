<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\StudentProfileContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\ImageManager;

class StudentProfileService implements StudentProfileContract
{
    protected $webResourceRetriever = null;
    protected $rosterRetriever = null;
    protected $imageCRUD = null;

    public function __construct(
        WebResourceRetrieverContract $webResourceRetriever,
        RosterRetrievalContract $rosterRetriever,
        ImageCRUDContract $imageCRUD
    ) {
        $this->webResourceRetriever = $webResourceRetriever;
        $this->rosterRetriever = $rosterRetriever;
        $this->imageCRUD = $imageCRUD;
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

        $imagePriority = $this
            ->imageCRUD
            ->getPriority([\str_replace('members:', '', $profile['individuals_id'])])[0];

        $studentProfile = (object) [
            'display_name' => $profile['display_name'],
            'first_name' => \explode(' ', $profile['display_name'])[0],
            'last_name' => \substr(\strstr($profile['display_name'], ' '), 1),
            'email' => $email,
            'student_id' => $profile['individuals_id'],
            'members_id' => $profile['individuals_id'],
            'notes' => $note == null ? 'Notes go here.' : Crypt::decrypt($note->notepad),
            'image_priority' => $imagePriority,
        ];

        $moreInfo = $this->rosterRetriever->sanitizeStudent($studentProfile);

        $studentProfile->images = $moreInfo['images'];

        return \json_encode($studentProfile);
    }

    public function updateStudentNotes(Request $request)
    {
        $note = Note::where('user_id', auth()->user()->user_id)
            ->where('student_id', $request->student_id)
            ->first();

        $note = Note::updateOrCreate(
            ['user_id' => auth()->user()->user_id, 'student_id' => $request->student_id],
            ['notepad' => Crypt::encrypt($request->notepad)]
        );

        return 'Updated';
    }
}

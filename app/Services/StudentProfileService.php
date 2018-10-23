<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\ImageCRUDContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\StudentProfileContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Models\Note;
use Illuminate\Support\Facades\Crypt;

class StudentProfileService implements StudentProfileContract
{
    protected $webResourceUtility = null;
    protected $rosterRetrieverUtility = null;
    protected $imageCRUDUtility = null;

    public function __construct(
        WebResourceRetrieverContract $webResourceUtility,
        RosterRetrievalContract $rosterRetrieverUtility,
        ImageCRUDContract $imageCRUDUtility
    ) {
        $this->webResourceUtility = $webResourceUtility;
        $this->rosterRetrieverUtility = $rosterRetrieverUtility;
        $this->imageCRUDUtility = $imageCRUDUtility;
    }

    public function getStudentProfile($email)
    {
        $email = $this->ensureStudentEmailWorks($email);
        $profile = \json_decode($this->webResourceUtility->getStudent($email), true);
        if ($profile['status'] === '200') {
            $profile = $profile['people'];
            $note = Note::where('user_id', auth()->user()->user_id)
                ->where('student_id', $profile['individuals_id'])
                ->first();

            $imagePriority = $this
                ->imageCRUDUtility
                ->getPriority([\str_replace('members:', '', $profile['individuals_id'])])[0];

            $studentProfile = (object) [
                'display_name' => $profile['display_name'],
                'first_name' => \explode(' ', $profile['display_name'])[0],
                'last_name' => \substr(\strstr($profile['display_name'], ' '), 1),
                'email' => $email,
                'student_id' => $profile['individuals_id'],
                'members_id' => $profile['individuals_id'],
                'notes' => $note == null ? '' : Crypt::decrypt($note->notepad),
                'image_priority' => $imagePriority,
                'bio' => $profile['biography'],
            ];

            return \json_encode($studentProfile);
        }
    }

    public function getStudentProfileWithNoEmail($data)
    {
        $display_name = $data['first_name'].' '.$data['last_name'];

        $note = Note::where('student_id', $data['student_id'])
            ->firstOrFail();

        $imagePriority = 'likeness';

        $studentProfile = (object) [
            'display_name' => $display_name,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'student_id' => $data['student_id'],
            'members_id' => $data['student_id'],
            'notes' => $note == null ? '' : Crypt::decrypt($note->notepad),
            'image_priority' => $imagePriority,
            'bio' => null, // if no email, then no bio
        ];

        return \json_encode($studentProfile);
    }

    public function updateStudentNotes($data)
    {
        Note::updateOrCreate(
            ['user_id' => auth()->user()->user_id, 'student_id' => $data['student_id']],
            ['notepad' => Crypt::encrypt($data['notepad'])]
        );

        return 'Updated';
    }

    private function ensureStudentEmailWorks($email)
    {
        $regex = "/(\D)*\.(\D)*\.(\d)*@.*/";
        $checkerEmail = \substr($email, 0, \strpos($email, '@'));
        if (\preg_match($regex, $email)) {
            return $email;
        }

        return $checkerEmail . '@csun.edu';
    }
}

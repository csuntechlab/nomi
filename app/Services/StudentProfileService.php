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
        $email = $this->ensureStudentEmailWorks($email);
        $profile = \json_decode($this->webResourceRetriever->getStudent($email), true);
        if ($profile['status'] === '200') {
            $profile = $profile['people'];
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
                'notes' => $note == null ? '' : Crypt::decrypt($note->notepad),
                'image_priority' => $imagePriority,
            ];

            return \json_encode($studentProfile);
        }
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

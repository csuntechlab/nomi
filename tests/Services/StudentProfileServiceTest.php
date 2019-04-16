<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Contracts\ImageCRUDContract;
use App\Contracts\RosterRetrievalContract;
use App\Contracts\WebResourceRetrieverContract;
use App\Models\Note;
use App\Models\User;
use App\Services\StudentProfileService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Crypt;
use Mockery;
use Tests\TestCase;

class StudentProfileServiceTest extends TestCase
{
    use DatabaseMigrations;

    public $webResourceRetriever;
    public $rosterRetriever;
    public $imageCRUD;

    public function setUp()
    {
        parent::setUp();
        $this->webResourceRetriever = Mockery::spy(WebResourceRetrieverContract::class);
        $this->rosterRetriever = Mockery::spy(RosterRetrievalContract::class);
        $this->imageCRUD = Mockery::spy(ImageCRUDContract::class);
    }

    /** @test */
    public function getStudentProfile_returns_a_student_profile()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $studentService = new StudentProfileService(
            $this->webResourceRetriever,
            $this->rosterRetriever,
            $this->imageCRUD
        );

        $note = factory(Note::class)->make([
            'student_id' => 'members:student',
            'user_id' => 'members:professor',
            'notepad' => Crypt::encrypt('This is a note'),
        ])->save();

        $email = 'this.is.555@WorkingEmail.com';

        $this->webResourceRetriever
            ->shouldReceive('getStudent')
            ->withArgs([$email])
            ->andReturn(\json_encode([
                'people' => [
                    'profile_image' => 'thisIsAnImage',
                    'individuals_id' => 'members:student',
                    'display_name' => 'Sun Ra',
                    'first_name' => 'Sun',
                    'last_name' => 'Ra',
                    'biography' => 'This is my bio, look, I am interesting',
                ],
                'success' => 'true',
                'status' => '200',
        ]));

        $this->imageCRUD
            ->shouldReceive('getPriority')
            ->withArgs([['student']])
            ->andReturn(['likeness']);

        $studentProfile = (object) [
            'display_name' => 'Sun Ra',
            'first_name' => 'Sun',
            'last_name' => 'Ra',
            'email' => $email,
            'student_id' => 'members:student',
            'notes' => 'This is a note',
            'image_priority' => 'likeness',
            'bio' => 'This is my bio, look, I am interesting',
        ];

        $output = $studentService->getStudentProfile($email);

        $this->assertEquals(\json_encode($studentProfile), $output);
    }

    /** @test */
    public function getStudentProfile_returns_a_null_student_profile_if_call_is_not_successful()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $studentService = new StudentProfileService(
            $this->webResourceRetriever,
            $this->rosterRetriever,
            $this->imageCRUD
        );

        $note = factory(Note::class)->make([
            'student_id' => 'members:student',
            'user_id' => 'members:professor',
            'notepad' => Crypt::encrypt('This is a note'),
        ])->save();

        $email = 'this.is.555@WorkingEmail.com';

        $this->webResourceRetriever
            ->shouldReceive('getStudent')
            ->withArgs([$email])
            ->andReturn(\json_encode([
                'people' => [
                    'profile_image' => 'thisIsAnImage',
                    'individuals_id' => 'members:student',
                    'display_name' => 'Sun Ra',
                    'bio' => 'This is my bio, look, I am interesting',
                ],
                'success' => 'false',
                'status' => 400,
        ]));

        $this->imageCRUD
            ->shouldReceive('getPriority')
            ->withArgs([['student']])
            ->andReturn(['likeness']);

        $studentProfile = null;

        $output = $studentService->getStudentProfile($email);

        $this->assertEquals($studentProfile, $output);
    }

    /** @test */
    public function getStudentProfileWithNoEmail_returns_a_student_profile()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $studentService = new StudentProfileService(
          $this->webResourceRetriever,
          $this->rosterRetriever,
          $this->imageCRUD
      );

        $note = factory(Note::class)->make([
          'student_id' => 'members:student',
          'user_id' => 'members:professor',
          'notepad' => Crypt::encrypt('Hi liad'),
      ])->save();

        $imagePriority = $this->imageCRUD
          ->shouldReceive('getPriority')
          ->withArgs([['student']])
          ->andReturn(['likeness']);

        $data = [
          'student_id' => 'members:student',
          'first_name' => 'luis',
          'last_name' => 'guzman',
      ];

        $test = \json_encode([
          'display_name' => $data['first_name'] . ' ' . $data['last_name'],
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'student_id' => $data['student_id'],
          'notes' => 'Hi liad',
          'image_priority' => 'likeness',
          'bio' => null, // if no email, then no bio
      ]);

        $output = $studentService->getStudentWithNoEmail($data);

        $this->assertEquals($output, $test);
    }

    /** @test */
    public function updateStudentNotes_creates_a_new_note()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $studentService = new StudentProfileService(
            $this->webResourceRetriever,
            $this->rosterRetriever,
            $this->imageCRUD
        );

        $data = [
            'id' => 1,
            'student_id' => 'student',
            'notepad' => 'wow a note',
        ];

        $this->assertDatabaseMissing('notes', ['haha']);

        $studentService->updateStudentNotes($data);

        $data['user_id'] = 'members:professor';
        $data['notepad'] = Crypt::encrypt($data['notepad']);

        $this->assertDatabaseHas('notes', [
            'id' => $data['id'],
            'student_id' => $data['student_id'],
            ]);
    }

    /** @test */
    public function updateStudentNotes_updates_an_existing_note()
    {
        $user = new User();
        $user->user_id = 'members:professor';
        $this->be($user);

        $studentService = new StudentProfileService(
            $this->webResourceRetriever,
            $this->rosterRetriever,
            $this->imageCRUD
        );

        $note = factory(Note::class)->make([
            'student_id' => 'members:student',
            'user_id' => 'members:professor',
            'notepad' => Crypt::encrypt('This is a note'),
        ])->save();

        $data = [
            'student_id' => 'members:student',
            'notepad' => 'wow a note',
        ];

        $this->assertDatabaseHas('notes', ['student_id' => $data['student_id']]);

        $studentService->updateStudentNotes($data);

        $this->assertDatabaseHas('notes', ['student_id' => $data['student_id']]);
    }
}

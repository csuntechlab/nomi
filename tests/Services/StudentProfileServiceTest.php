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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Mockery;
use Tests\TestCase;

class StudentProfileServiceTest extends TestCase
{
    use RefreshDatabase;
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
        $user = new User(['user_id' => 'professor']);
        $this->be($user);

        $studentService = new StudentProfileService(
            $this->webResourceRetriever,
            $this->rosterRetriever,
            $this->imageCRUD
        );

        $note = factory(Note::class)->make([
            'student_id' => 'student',
            'user_id' => 'professor',
            'notepad' => Crypt::encrypt('This is a note'),
        ]);

        $email = 'this.is.555@WorkingEmail.com';

        $this->webResourceRetriever
            ->shouldReceive('getStudent')
            ->withArgs([$email])
            ->andReturn(\json_encode(['people' => [
                'profile_image' => 'thisIsAnImage',
                'individuals_id' => 'student',
                'display_name' => 'Sun Ra',
            ],
        ]));

        $studentService->getStudentProfile($email);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\StudentProfileContract;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class StudentProfileControllerTest extends TestCase
{
    public $retriever;

    /**
     * Description: Sets up the test and makes a mock of
     *              ImageCRUDContract.
     */
    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(StudentProfileContract::class);
    }

    /**
     * @test
     */
    public function getProfile_retrieves_profile_based_on_email_with_retriever()
    {
        $controller = new StudentProfileController($this->retriever);

        $this->retriever
            ->shouldReceive('getStudentProfile')
            ->once();

        $controller->getProfile('testEmail');
    }

    /**
     * @test
     */
    public function updateNotes_calls_on_the_update_notes_function_in_the_retriever()
    {
        $controller = new StudentProfileController($this->retriever);

        $this->retriever
            ->shouldReceive('updateStudentNotes')
            ->once();

        $request = new Request();

        $request->student_id = 'members:100';
        $request->notepad = 'beep boop I\'m a note';

        $controller->updateNotes($request);
    }

    /**
     * @test
     */
    public function getProfileWithNoEmail_retrieves_profile_based_off_request()
    {
        $controller = new StudentProfileController($this->retriever);

        $this->retriever
            ->shouldReceive('getStudentWithNoEmail')
            ->once();

        $request = new Request();

        $request->student_id = 'bigboi:420';
        $request->first_name = 'plz';
        $request->last_name = 'work';

        $controller->getProfileWithNoEmail($request);
    }
}

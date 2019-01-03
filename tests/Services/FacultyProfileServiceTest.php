<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Contracts\WebResourceRetrieverContract;
use App\Models\User;
use App\Services\FacultyProfileService;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class FacultyProfileServiceTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(WebResourceRetrieverContract::class);
    }

    /** @test */
    public function getFacultyProfile_returns_image_id_firstname_and_lastname()
    {
        $facultyService = new FacultyProfileService($this->retriever);

        $user = new User([
          'user_id' => 'members:1',
          'first_name' => 'anakin',
          'last_name' => 'skywalker',
        ]);

        $this->be($user);

        Auth::shouldReceive('user')
            ->andReturn($user);

        $returnArray = [
            'image' => env('MEDIA_URL') . 'MrTeacherMan@gmail.com',
            'id' => 'members:1',
            'name_first' => 'anakin',
            'name_last' => 'skywalker',
        ];

        $output = $facultyService->getFacultyProfile('MrTeacherMan@gmail.com');
        $this->assertEquals($output, $returnArray);
    }
}

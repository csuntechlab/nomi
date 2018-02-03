<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\RosterRetrievalContract;
use App\Http\Controllers\RosterController;
use Mockery;
use Tests\TestCase;

class RosterControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(RosterRetrievalContract::class);
    }

    /**
     * @test
     */
    public function can_get_students()
    {
        $controller = new RosterController($this->retriever);

        $this->retriever
            ->shouldReceive('getStudentsFromRoster')
            ->once()
            ->with('2173', '0')
            ->andReturn(['a', 'b', 'c']);
        $response = $controller->getStudents('2173', '0');
        $this->assertEquals(['a', 'b', 'c'], $response);
    }

    /**
     * @test
     */
    public function can_shuffle_students()
    {
        $controller = new RosterController($this->retriever);

        $this->retriever
            ->shouldReceive('getStudentsFromRoster')
            ->once()
            ->with('2173', '0')
            ->andReturn(['a', 'b', 'c']);
        $response = $controller->shuffleStudents('2173', '0');
        $this->assertTrue(
            \in_array('a', $response) &&
            \in_array('b', $response)
        ) &&
            \in_array('c', $response);
    }
}

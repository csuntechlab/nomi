<?php

declare(strict_types=1);

namespace Tests\Controllers;

use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /** @test */
    public function can_hit_login_index_page()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function faculty_can_login()
    {
        $data = ['username' => 'steve', 'password' => ''];
        $response = $this->call('POST', '/', $data);
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function non_faculty_cannot_login()
    {
        $data = ['username' => 'jeffery.d.barrow', 'password' => ''];
        $response = $this->call('POST', '/', $data);
        $this->assertEquals(302, $response->status());
    }
}

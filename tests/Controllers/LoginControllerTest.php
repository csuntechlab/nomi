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
}

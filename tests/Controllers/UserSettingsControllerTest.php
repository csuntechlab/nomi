<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Contracts\UserSettingsContract;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class UserSettingsControllerTest extends TestCase
{
    public $retriever;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(UserSettingsContract::class);
    }

    /**
     * @test
     */
    public function getSettings_gets_settings_in_retriever()
    {
        $controller = new UserSettingsController($this->retriever);

        $this->retriever
            ->shouldReceive('getSettings')
            ->once();

        $controller->getSettings(new Request());
    }

    /**
     * @test
     */
    public function updateTheme_calls_service_to_update_theme()
    {
        $controller = new UserSettingsController($this->retriever);

        $this->retriever
            ->shouldReceive('updateTheme')
            ->once();

        $controller->updateTheme(new Request());
    }
}

<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserService $userService2;
    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
        $this->userService2 = $this->app->make(UserService::class);
    }

    public function testSingleton()
    {
        self::assertSame($this->userService, $this->userService2);
    }

    public function testLoginSuccess()
    {
        $response = $this->userService->login("admin", "rahasia");
        self::assertTrue($response);
    }

    public function testLoginNull()
    {
        $response = $this->userService->login("", "");
        self::assertFalse($response);
    }

    public function testLoginWrong()
    {
        $response = $this->userService->login("admin", "salah");
        self::assertFalse($response);
    }
}

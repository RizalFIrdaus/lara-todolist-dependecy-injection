<?php

namespace Tests\Feature;

use App\Repository\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserService $userService2;
    private UserRepository $userRepository;
    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
        $this->userService2 = $this->app->make(UserService::class);
        $this->userRepository = $this->app->make(UserRepository::class);
        $this->userRepository->deleteAll();
    }

    public function testSingleton()
    {
        self::assertSame($this->userService, $this->userService2);
    }

    public function testRegister()
    {
        $request = new Request();
        $request["name"] = "rizal";
        $request["username"] = "rizal300500";
        $request["password"] = "rizal300500000";
        $response = $this->userService->register($request);
        self::assertEquals("rizal", $response->name);
        self::assertEquals("rizal300500", $response->username);
        self::assertTrue(Hash::check("rizal300500000", $response->password));
    }
}

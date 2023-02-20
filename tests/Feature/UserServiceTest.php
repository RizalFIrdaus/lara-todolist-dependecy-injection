<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        // $this->userRepository->deleteAll();
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
    public function testLogin()
    {
        $user = new User();
        $user->name = "rizal";
        $user->username = "rizal300500";
        $user->password = Hash::make("rahasia123");
        $this->userRepository->saveUser($user);
        $request = new Request();
        $request["username"] = "rizal300500";
        $request["password"] = "rahasia123";
        $response = $this->userService->login($request);
        self::assertEquals("rizal300500", $response->username);
        self::assertTrue(Hash::check("rahasia123", $response->password));
    }
}

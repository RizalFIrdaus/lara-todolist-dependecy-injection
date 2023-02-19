<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;
    private UserRepository $testSingleton;
    private User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->app->make(UserRepository::class);
        $this->testSingleton = $this->app->make(UserRepository::class);
        $this->userRepository->deleteAll();

        $this->user = new User();
        $this->user->name = "rizal";
        $this->user->username = "rizal300500";
        $this->user->password = Hash::make("rahasia123");
    }

    public function testSingleton()
    {
        self::assertSame($this->userRepository, $this->testSingleton);
    }

    public function testSaveUser()
    {

        $response = $this->userRepository->saveUser($this->user);

        self::assertEquals($this->user->name, $response->name);
        self::assertEquals($this->user->username, $response->username);
        self::assertEquals($this->user->password, $response->password);
    }

    public function testGetUserFound()
    {
        $this->userRepository->saveUser($this->user);
        $response = $this->userRepository->getUser($this->user->username);
        self::assertEquals($this->user->name, $response->name);
        self::assertEquals($this->user->username, $response->username);
        self::assertTrue(Hash::check("rahasia123", $response->password));
    }

    public function testGetUserNotFound()
    {
        $response = $this->userRepository->getUser("NGASAL");
        self::assertNull($response);
    }

    public function testDeleteUserFound()
    {
        $this->userRepository->saveUser($this->user);
        $response = $this->userRepository->deleteUser($this->user->username);
        self::assertTrue($response);
    }
    public function testDeleteUserNotFound()
    {
        $this->userRepository->saveUser($this->user);
        $response = $this->userRepository->deleteUser("NGASAL");
        self::assertFalse($response);
    }

    public function testUpdateSuccess()
    {
        $user = $this->userRepository->saveUser($this->user);
        self::assertEquals($this->user->username, $user->username);
        self::assertEquals($this->user->name, $user->name);
        $this->user->name = "firdaus";
        $response = $this->userRepository->updateUser($this->user, $this->user->username);
        self::assertEquals($this->user->name, $response->name);
    }
}

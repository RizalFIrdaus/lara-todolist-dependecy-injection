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
    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->app->make(UserRepository::class);
        $this->testSingleton = $this->app->make(UserRepository::class);
        $this->userRepository->deleteAll();
    }

    public function testSingleton()
    {
        self::assertSame($this->userRepository, $this->testSingleton);
    }

    public function testSaveUser()
    {
        $user = new User();
        $user->name = "Kodok";
        $user->username = "KOdok";
        $user->password = "kODOK";
        $response = $this->userRepository->saveUser($user);

        self::assertEquals($user->name, $response->name);
        self::assertEquals($user->username, $response->username);
        self::assertEquals($user->password, $response->password);
    }
}

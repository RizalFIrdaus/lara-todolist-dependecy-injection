<?php

namespace Tests\Feature;

use App\Repository\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    }

    public function testSingleton()
    {
        self::assertSame($this->userRepository, $this->testSingleton);
    }
}

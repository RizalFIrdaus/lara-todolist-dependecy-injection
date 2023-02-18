<?php

namespace Tests\Feature;

use App\Repository\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public UserRepository $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->app->make(UserRepository::class);
        $this->userRepository->deleteAll();
    }

    public function testViewRegister()
    {
        $this->get("/register")
            ->assertSeeText("Register")
            ->assertSeeText("Username")
            ->assertSeeText("Password")
            ->assertSeeText("Name");
    }

    public function testRegisterPostSuccess()
    {
        $this->post("/register", [
            "name" => "rizal",
            "username" => "rizal300500",
            "password" => "rahasia12345"
        ])->assertRedirect("/login");
    }
    public function testRegisterPostFailed()
    {
        $this->post("/register", [])
            ->assertRedirect("/");
    }
}

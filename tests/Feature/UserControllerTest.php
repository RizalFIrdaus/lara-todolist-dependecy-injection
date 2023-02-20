<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    public UserRepository $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->app->make(UserRepository::class);
        // $this->userRepository->deleteAll();
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

    public function testUserController()
    {
        $user = new User();
        $user->name = "rizal";
        $user->username = "rizal300500";
        $user->password = "rahasia12345";
        $user_res = $this->userRepository->saveUser($user);
        $get_user = $this->userRepository->getUser($user_res->username);
        $this->withSession(["user" => $get_user])
            ->get("/change-name")
            ->assertSeeText("Change Name");
    }
    public function testChangePasswordAccount()
    {
        $get_user = $this->userRepository->getUser(6);
        $this->withSession(["user" => $get_user])
            ->get("/change-password")
            ->assertSeeText("Change Password");
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginView()
    {
        $this->get("/login")
            ->assertSeeText("Muhammad Rizal Firdaus")
            ->assertSeeText("Login")
            ->assertDontSeeText("Login Management");
    }

    public function testdoLoginSuccess()
    {
        $this->post("/login", [
            "user" => "admin",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user")
            ->assertDontSeeText("Login");
    }

    public function testDoLoginFailedWrong()
    {
        $this->post("/login", [
            "user" => "admin",
            "password" => "salah"
        ])->assertSeeText("Username or password is wrong");
    }

    public function testDoLoginFailedNull()
    {
        $this->post("/login", [
            "user" => "",
            "password" => ""
        ])->assertSeeText("Username or password is null");
    }
}

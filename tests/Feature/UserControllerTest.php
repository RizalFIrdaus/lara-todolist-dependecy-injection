<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testViewRegister()
    {
        $this->get("/register")
            ->assertSeeText("Register")
            ->assertSeeText("Username")
            ->assertSeeText("Password")
            ->assertSeeText("Name");
    }
}

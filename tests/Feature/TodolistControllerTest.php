<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolistIndexSuccess()
    {
        $this->withSession([
            "user" => "admin"
        ])->get("/todo")
            ->assertSessionHas("user")
            ->assertSeeText("by admin");
    }
    public function testTodolistIndexFailed()
    {
        $this->get("/todo")
            ->assertSessionMissing("user")
            ->assertRedirect("/login");
    }
}

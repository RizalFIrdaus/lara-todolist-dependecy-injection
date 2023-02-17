<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    private TodolistService $todolistService;
    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }
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

    public function testStoreTodolist()
    {
        $this->withSession([
            "user" => "admin"
        ])->post("/todo", [
            "todo" => "Belajar Laravel"
        ])->assertSessionHas("todo");
    }

    public function testDestroyTodolist()
    {
        $unique = uniqid();
        $this->todolistService->saveTodo($unique, "Belajar 1");
        $this->withSession([
            "user" => "admin"
        ])->post("/todo")->assertSessionHas("todo")
            ->assertSeeText("Belajar 1");
        $this->withSession([
            "user" => "admin"
        ])->post("/todo/" . $unique . "/delete")->assertSessionHas("todo")
            ->assertDontSeeText("Belajar 1");
    }
}

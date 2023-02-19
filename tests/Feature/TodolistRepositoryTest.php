<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Repository\TodolistRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistRepositoryTest extends TestCase
{
    private TodolistRepository $todolistRepository;
    private Todo $todo;

    public function setUp(): void
    {
        parent::setUp();
        $this->todolistRepository = $this->app->make(TodolistRepository::class);
        $this->todolistRepository->deleteAll();
        $this->todo = new Todo();
        $this->todo->todo = "Belajar Laravel";
    }

    public function testTodolistSingleton()
    {
        $singleton = $this->app->make(TodolistRepository::class);
        self::assertSame($singleton, $this->todolistRepository);
    }

    public function testSaveTodolist()
    {
        $response = $this->todolistRepository->saveTodo($this->todo);
        self::assertEquals($this->todo->todo, $response->todo);
    }

    public function testGetTodolist()
    {
        $todolist = $this->todolistRepository->saveTodo($this->todo);
        $response = $this->todolistRepository->getTodo("1");
        self::assertNotNull($response->id);
        self::assertNotNull($response->todo);
        self::assertEquals($todolist->id, $response->id);
        self::assertEquals($todolist->todo, $response->todo);
    }

    public function testUpdateTodolist()
    {
        $todolist = $this->todolistRepository->saveTodo($this->todo);
        self::assertEquals("Belajar Laravel", $todolist->todo);
        $this->todo->todo = "Update";
        $response = $this->todolistRepository->updateTodo("1", $this->todo);
        self::assertEquals($this->todo->todo, $response->todo);
    }

    public function testDeleteTodolist()
    {
        $this->todolistRepository->saveTodo($this->todo);
        $todolist = $this->todolistRepository->getTodo("1");
        self::assertNotNull($todolist);
        $todolist = $this->todolistRepository->deleteTodo("1");
        $todolist2 = $this->todolistRepository->getTodo("1");
        self::assertNull($todolist2);
    }
}

<?php

namespace App\Services\Imp;

use App\Models\Todo;
use App\Repository\TodolistRepository;
use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistServiceImp implements TodolistService
{
    public function __construct(private TodolistRepository $todolistRepository)
    {
    }
    public function saveTodo(Request $request): void
    {
        $todo = new Todo();
        $todo->todo = $request->input("todo");
        $this->todolistRepository->saveTodo($todo);
    }
    public function getTodo(string $id): Todo
    {
        return $this->todolistRepository->getTodo($id);
    }
    public function removeTodo(string $id)
    {
        $this->todolistRepository->deleteTodo($id);
    }

    public function allTodo()
    {
        return $this->todolistRepository->allTodo();
    }
}

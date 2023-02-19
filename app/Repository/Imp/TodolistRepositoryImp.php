<?php

namespace App\Repository\Imp;

use App\Models\Todo;
use App\Repository\TodolistRepository;
use Illuminate\Support\Facades\Session;

class TodolistRepositoryImp implements TodolistRepository
{
    public function getTodo(string $id): ?Todo
    {
        $todoList = Todo::where("id", $id)->first();
        if (!$todoList) return null;
        return $todoList;
    }
    public function saveTodo(Todo $todo): Todo
    {
        $user = Session::get("user");

        $todoList = new Todo();
        $todoList->user_id = $user->id;
        $todoList->todo = $todo->todo;
        $todoList->save();
        return $todoList;
    }
    public function updateTodo(string $id, Todo $todo): ?Todo
    {
        $user = Session::get("user");

        $todoList = $this->getTodo($id);
        if (!$todoList) return null;
        $todoList->user_id = $user->id;
        $todoList->todo = $todo->todo;
        $todoList->update();
        return $todoList;
    }

    public function deleteTodo(string $id): bool
    {
        $todoList = $this->getTodo($id);
        if (!$todoList) return false;
        $todoList->delete();
        return true;
    }

    public function allTodo()
    {
        $session = Session::get("user");
        return Todo::where("user_id", $session->id)->get();
    }

    public function deleteAll(): void
    {
        Todo::truncate();
    }
}

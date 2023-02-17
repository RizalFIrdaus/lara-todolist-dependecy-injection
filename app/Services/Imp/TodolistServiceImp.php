<?php

namespace App\Services\Imp;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImp implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::get("todo")) {
            Session::put("todo", []);
        }

        Session::push("todo", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodo(): array
    {
        return Session::get("todo", []);
    }

    public function removeTodo(string $id)
    {
        $todo = Session::get("todo");
        foreach ($todo as $key => $value) {
            if ($value["id"] == $id) {
                unset($todo[$key]);
                break;
            }
        }
        Session::put("todo", $todo);
    }
}

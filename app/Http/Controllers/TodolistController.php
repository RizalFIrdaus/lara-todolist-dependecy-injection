<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{

    public function __construct(private TodolistService $todolistService)
    {
    }

    public function index(Request $request): Response
    {
        return response()->view("user.todolist", [
            "title" => "Todo List",
            "user" => $request->session()->get("user"),
            "todo" => $request->session()->get("todo", [])
        ]);
    }

    public function store(Request $request): Response
    {
        $todo = $request->input("todo");
        if (empty($todo)) {
            return response()->view("user.todolist", [
                "title" => "Todolist Management",
                "error" => "Todolist is null"
            ]);
        }
        $this->todolistService->saveTodo(uniqid(), $todo);
        return response()->view("user.todolist", [
            "title" => "Todolist Management",
            "user" => $request->session()->get("user"),
            "todo" => $request->session()->get("todo", [])
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        if (empty($id)) {
            return response()->view("user.todolist", [
                "title" => "Todolist Management",
                "error" => "Id is Null"
            ]);
        }
        $this->todolistService->removeTodo($id);
        return redirect("/todo");
    }
}

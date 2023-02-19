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
        $todos = $this->todolistService->allTodo();
        return response()->view("user.todolist", [
            "title" => "Todo List",
            "user" => $request->session()->get("user"),
            "todo" => $todos
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "todo" => "required"
        ]);
        $this->todolistService->saveTodo($request);
        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $this->todolistService->removeTodo($id);
        return redirect()->back();
    }
}

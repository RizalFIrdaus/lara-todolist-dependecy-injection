<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function index(Request $request)
    {
        return response()->view("user.todolist", [
            "title" => "Todo List",
            "user" => $request->session()->get("user")
        ]);
    }
}

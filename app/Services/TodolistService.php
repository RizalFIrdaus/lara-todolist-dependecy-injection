<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Http\Request;

interface TodolistService
{
    public function saveTodo(Request $request): void;
    public function getTodo(string $id): Todo;
    public function removeTodo(string $id);
    public function allTodo();
}

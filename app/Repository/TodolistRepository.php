<?php

namespace App\Repository;

use App\Models\Todo;

interface TodolistRepository
{
    public function saveTodo(Todo $todo): Todo;
    public function getTodo(string $id): ?Todo;
    public function allTodo();
    public function updateTodo(string $id, Todo $todo): ?Todo;
    public function deleteTodo(string $id): bool;
    public function deleteAll(): void;
}

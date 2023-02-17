<?php

namespace App\Services;


interface TodolistService
{
    public function saveTodo(string $id, string $todo): void;
    public function getTodo(): array;
    public function removeTodo(string $id);
}

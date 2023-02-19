<?php

namespace App\Repository;

interface TodolistRepository
{
    public function saveTodo();
    public function getTodo();
    public function updateTodo();
    public function deleteTodo();
    public function deleteAll();
}

<?php

namespace App\Services;

interface UserService
{
    public function login(string $user, string $password): bool;
}

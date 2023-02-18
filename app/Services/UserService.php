<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface UserService
{
    public function login(string $user, string $password): bool;
    public function register(Request $request): User;
}

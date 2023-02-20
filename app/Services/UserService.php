<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface UserService
{
    public function login(Request $request): ?User;
    public function register(Request $request): User;
    public function changeName(Request $request): User;
    public function changePassword(Request $request): ?User;
}

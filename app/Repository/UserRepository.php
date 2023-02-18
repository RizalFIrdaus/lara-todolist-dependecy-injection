<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepository
{
    public function saveUser(User $user): User;
    public function getUser(string $username);
    public function updateUser(User $users, string $username): ?User;
    public function deleteUser(string $username): bool;
    public function deleteAll(): void;
}

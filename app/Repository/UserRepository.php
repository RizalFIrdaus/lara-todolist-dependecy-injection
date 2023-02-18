<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepository
{
    public function saveUser(User $user): User;
    public function getUser(string $id): ?User;
    public function updateUser(Request $request, string $id): bool;
    public function deleteUser(string $id): bool;
    public function deleteAll(): void;
}

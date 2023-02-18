<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepository
{
    public function saveUser(Request $request);
    public function getUser(string $id): ?User;
    public function updateUser(User $user): bool;
    public function deleteUser(User $user): bool;
}

<?php

namespace App\Repository\Imp;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserRepositoryImp implements UserRepository
{
    public function saveUser(User $users): User
    {
        $user = new User();
        $user->name = $users->name;
        $user->username = $users->username;
        $user->password = $users->password;
        $user->save();
        return $user;
    }

    public function getUser(string $id): ?User
    {
        return new User();
    }

    public function deleteUser(string $id): bool
    {
        return true;
    }
    public function updateUser(Request $request, string $id): bool
    {
        return true;
    }
    public function deleteAll(): void
    {
        User::truncate();
    }
}

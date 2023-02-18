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

    public function getUser(string $username)
    {
        $user = User::where("username", $username)->first();
        if (!$user) return null;
        return $user;
    }

    public function deleteUser(string $username): bool
    {
        $user = User::where("username", $username)->first();
        if (!$user) return false;
        $user->delete();
        return true;
    }
    public function updateUser(User $users, string $username): ?User
    {
        $user = User::where("username", $username)->first();
        if (!$user) return null;
        $user->name = $users->name;
        $user->username = $users->username;
        $user->password = $users->password;
        $user->update();
        return $user;
    }
    public function deleteAll(): void
    {
        User::truncate();
    }
}

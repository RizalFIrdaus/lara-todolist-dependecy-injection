<?php

namespace App\Repository\Imp;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserRepositoryImp implements UserRepository
{
    public function saveUser(Request $request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        $user->password = $request->input("password");
        $user->save();
    }

    public function getUser(string $id): ?User
    {
        return new User();
    }

    public function deleteUser(User $user): bool
    {
        return true;
    }
    public function updateUser(User $user): bool
    {
        return true;
    }
}

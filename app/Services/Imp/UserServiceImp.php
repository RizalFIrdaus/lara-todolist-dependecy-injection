<?php

namespace App\Services\Imp;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserServiceImp implements UserService
{
    private array $users = ["admin" => "rahasia"];

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = App::make(UserRepository::class);
    }

    public function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) return false;
        $correctPassword = $this->users[$user];
        return $password == $correctPassword ? true : false;
    }

    public function register(Request $request): User
    {
        $reponse = $request->validate([
            "name" => "required|min:3",
            "username" => "required|min:6",
            "password" => "required|min:8"
        ]);
        $user = new User();
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        $user->password = Hash::make($request->input("password"));
        $this->userRepository->saveUser($user);
        return $user;
    }
}

<?php

namespace App\Services\Imp;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserServiceImp implements UserService
{
    private array $users = ["admin" => "rahasia"];

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = App::make(UserRepository::class);
    }

    public function login(Request $request): ?User
    {
        $request->validate([
            "username" => "required|min:6",
            "password" => "required|min:8"
        ]);
        $user = $this->userRepository->getUser($request->username);
        if (!$user) return null;
        if (Hash::check($request->password, $user->password)) {
            Session::put("user", $user->username);
            return $user;
        }
        return null;
    }

    public function register(Request $request): User
    {
        $request->validate([
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

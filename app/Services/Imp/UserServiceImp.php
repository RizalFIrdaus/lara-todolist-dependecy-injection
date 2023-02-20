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
            Session::put("user", $user);
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

    public function changeName(Request $request): User
    {
        $request->validate([
            "name" => "required|min:3",
        ]);
        $user_login = Session::get("user");
        $user = $this->userRepository->getUser($user_login->username);
        $user->name = $request->input("name");
        $user->update();
        Session::forget("user");
        Session::put(["user" => $user]);
        return $user;
    }

    public function changePassword(Request $request): ?User
    {
        $user_login = Session::get("user");
        $user = $this->userRepository->getUser($user_login->username);
        if (!$user) return null;
        if (Hash::check($request->input("old_password"), $user->password)) {
            if ($request->input("re_password") == $request->input("new_password")) {
                $user->password = Hash::make($request->input("new_password"));
                $user->update();
                return $user;
            }
            return null;
        }
        return null;
    }
}

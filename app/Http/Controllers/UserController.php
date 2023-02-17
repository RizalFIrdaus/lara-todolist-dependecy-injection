<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{


    public function __construct(private UserService $userService)
    {
    }

    public function Login(Request $request): Response|RedirectResponse
    {
        return response()->view("user.login", [
            "title" => "Login"
        ]);
    }

    public function doLogin(Request $request): RedirectResponse|Response
    {
        $user = $request->input("user");
        $password = $request->input("password");
        if (empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "Username or password is null"
            ]);
        }
        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect("/todo");
        }
        return response()->view("user.login", [
            "title" => "Login",
            "error" => "Username or password is wrong"
        ]);
    }

    public function doLogout(Request $request)
    {
        if ($request->session()->get("user")) {
            $request->session()->forget("user");
            return response()->redirectTo("/login");
        }
    }
}

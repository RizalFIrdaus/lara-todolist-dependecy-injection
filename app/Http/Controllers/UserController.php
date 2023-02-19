<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

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
        $user = $this->userService->login($request);
        if (!$user) {
            return redirect()->back()->withErrors(["username" => "Username or password is wrong !"]);
        }
        return redirect("/todo");
    }

    public function doLogout(Request $request)
    {
        if ($request->session()->get("user")) {
            $request->session()->forget("user");
            return response()->redirectTo("/login");
        }
    }

    public function Register(): Response
    {
        return response()->view("user.register", [
            "title" => "Register"
        ]);
    }

    public function doRegister(Request $request): Respoinse|RedirectResponse
    {
        $register = $this->userService->register($request);
        if (!$register) {
            return response()->view("user.register", [
                "title" => "Login",
                "error" => "Username or password is wrong"
            ]);
        }
        return response()->redirectTo("/login");
    }

    public function changeName(): Response|RedirectResponse
    {
        $user = Session::get("user");
        return response()->view("user.changeName", [
            "title" => "Change Name",
            "user" => $user
        ]);
    }

    public function doChangeName(Request $request): Response|RedirectResponse
    {
        $this->userService->changeName($request);
        return redirect()->back();
    }
}

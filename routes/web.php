<?php

use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Middleware\OnlyGuestMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/template", function () {
    return response()->view("template");
});

Route::controller(UserController::class)->group(function () {
    Route::get("/login", "Login")->middleware(OnlyGuestMiddleware::class);
    Route::post("/login", "doLogin")->middleware(OnlyGuestMiddleware::class);
    Route::get("/register", "Register")->middleware(OnlyGuestMiddleware::class);
    Route::post("/register", "doRegister")->middleware(OnlyGuestMiddleware::class);
    Route::post("/logout", "doLogout")->middleware(MemberMiddleware::class);
});
Route::middleware(MemberMiddleware::class)->controller(TodolistController::class)->group(function () {
    Route::get("/todo", "index");
    Route::post("/todo", "store");
    Route::post("/todo/{id}/delete", "destroy");
});

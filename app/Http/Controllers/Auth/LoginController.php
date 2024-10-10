<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            if(Auth::user()->role == ROLE_ADMIN) {
                return redirect()->route("dashboard.home");
            } else {
                return redirect()->route("frontend.home");
            }
        }
        return view("auth.login");
    }

    public function login(Request $request) {
        if (Auth::check() ) {
            if(Auth::user()->role == ROLE_ADMIN) {
                return redirect()->route("dashboard.home");
            } else {
                return redirect()->route("frontend.home");
            }
        }
        $validated = $request->validate([
            "email_or_username" => ["required"],
            "password" => ["required"]
        ]);
        $user = User::where("username", $validated["email_or_username"])->orWhere("email", $validated["email_or_username"])->first();
        if ($user && !$user->status) {
            return back()->withErrors("Your account is currently inactive!");
        }
        if ($user && Hash::check($validated["password"], $user->password)) {
            Auth::login($user, $request->has("remember"));
            if($user->role == ROLE_ADMIN) {
                return redirect()->route("dashboard.home");
            } else {
                return redirect()->route("frontend.home");
            }
        }
        return back()->withErrors("Your login credentials don't match!");
    }
}

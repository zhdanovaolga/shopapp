<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($username) {
        $user = User::where("status", true)->where("username", $username)->first();
        if ($user) {

            return view("frontend.user.index", compact("user"));
        }
        return abort(404);
    }
}

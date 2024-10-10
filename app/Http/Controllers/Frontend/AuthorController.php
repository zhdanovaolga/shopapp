<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $author = Author::orderBy("name", "ASC")->paginate(20);
        if ($author) {

            return view("frontend.author.author", compact("author"));
        }
        return abort(404);
    }
}

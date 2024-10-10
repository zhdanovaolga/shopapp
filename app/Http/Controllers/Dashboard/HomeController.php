<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $books = Book::count();
        $authors = Author::count();
        $users = User::count();
        $categories = Category::count();
        
        return view("dashboard.home.index", compact("books", "authors", "users", "categories"));
    }
}

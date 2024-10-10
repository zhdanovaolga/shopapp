<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::orderBy(Category::raw('RAND()'))->take(8)->get();
        $books = Book::orderBy("title", "ASC")
            ->available()
            ->paginate(10);
        return view("frontend.home.index", compact("categories", "books"));
    }
}

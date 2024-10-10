<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        if ($request->q) {
            $query = $request->q;
            $books = Book::with("category")
                ->available()
                ->where("title", "LIKE", "%{$query}%")
                ->orderBy("id", "DESC")->paginate(10);

                return view("frontend.search.index", compact("books", "query"));
        }

        return redirect()->route("frontend.home");
    }
}

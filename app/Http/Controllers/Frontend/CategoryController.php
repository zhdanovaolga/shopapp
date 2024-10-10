<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id) {
        $category = Category::where("id", $id)->first();
        if ($category) {
            $str = Str::class;
            $books = $category->books()->with(["category"])->where("category_id", $id)->orderBy("id", "DESC")->paginate(10);
            return view("frontend.category.index", compact("category", "books", "str"));
        }
        return abort(404);
    }

    public function view() {
        $categories = Category::where("title", "ASC")->paginate(10);
        if ($categories) {

            return view("frontend.category.category", compact("categories"));
        }
        return abort(404);
    }
}

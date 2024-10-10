<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function index() {
        //$books = Book::with(["category"])->orderBy("id", "ASC")->paginate(20);
        $books = Book::sortable()->paginate(5);
       
        return view("dashboard.book.index", compact("books"));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $book = Book::with(["category", 'current_user'])->where("id", $id)->first();

        return view("dashboard.book.book", compact("book"));
    }

    public function return($id) {
        $books = Book::with(["category"])
            ->where("rented", true)
            ->paginate(5);
        $book = Book::with(["category"])->where("id", $id)->first();
        $book->rented = false;
        $book->current_user_id = null;
        $book->rented_date = null;
        $book->save();

        if ($book) {
            return view("dashboard.book.rented", compact("book", "books"))->with("success", "Book's status updated!");
        }
        return back()->withErrors("Book not exists!");
    }

    public function rented() {
        $books = Book::sortable()->expiredRent()->paginate(5);
        
        return view("dashboard.book.rented", compact("books"));

    }

    public function create() {
        $categories = Category::orderBy("title", "ASC")->get();
        return view("dashboard.book.add", compact("categories"));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "title" => ["required", "string", "max:150"],
            "description" => ["required", "string", "max:150"],
            "image" => ["required", "image"],
            "price" => ["required", "string", "max:150"],
            "category" => ["required", "exists:categories,id"],
            "publish_year" => ["required", "numeric"],
        ]);
        
        if (Arr::has($validated, "image")) {
            $image = $request->file("image");
            $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
            $image->move(public_path("uploads/category"), $imageName);
        }
        Book::create([
            "title" => $validated["title"],
            "description" => $validated["description"],
            "image" => $imageName,
            "price" => $validated["price"],
            "category_id" => $validated["category"],
            "publish_year" => $validated["publish_year"],
        ]);
        return redirect()->route("dashboard.books.index")->with("success", "Book created!");
    }

    public function edit(string $id) {
        $categories = Category::orderBy("title", "ASC")->get();
        $book = Book::find($id);
        if ($book) {
            return view("dashboard.book.edit", compact("book", 'categories'));
        }
        return back()->withErrors("Book not exists!");
    }

    public function update(Request $request, string $id) {
        $book = Book::find($id);
        if ($book) {
            $validated = $request->validate([
                "title" => ["required", "string", "max:150"],
                "description" => ["required", "string", "max:150"],
                "image" => ["required", "image"],
                "price" => ["required", "string", "max:150"],
                "category" => ["required", "exists:categories,id"],
                "publish_year" => ["required", "numeric"],
                
            ]);
            $book->title = $validated["title"];
            $book->description = $validated["description"];
            $book->image = $validated["image"];
            $book->price = $validated["price"];
            $book->category_id = $validated["category"];
            $book->publish_year = $validated["publish_year"];
            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
                $image->move(public_path("uploads/category"), $imageName);
                if (File::exists(public_path("uploads/category/".$book->image))) {
                    File::delete(public_path("uploads/category/".$book->image));
                }
                $book->image = $imageName;
            }
            $book->save();
            return redirect()->route("dashboard.books.index")->with("success", "Book updated!");
        }
        return back()->withErrors("Book not exists!");
    }

    public function destroy(string $id) {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return back()->with("success", "Book deleted!");
        }
        return back()->withErrors("Book not exists!");
    }

}
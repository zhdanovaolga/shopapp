<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function books() {
        //$books = Book::with(["category"])->available();
        $books = Book::sortable()->available()->paginate(5);
        if ($books) {
            return view("frontend.book.book", compact("books"));
        }
        return abort(404);
    }

    public function view($id) {
        $book = Book::with(["category"])->where("id", $id)->first();

            return view("frontend.book.index", compact("book"));

    }

    public function rent($id, Request $request) {
        $book = Book::with(["category"])    
            ->available()
            ->where("id", $id)->first();

        return view("frontend.book.inc.rent", compact("book"));
    }

    public function setRent($id, Request $request) {
        $book = Book::with(["category"])
            ->available()
            ->where("id", $id)->first();

        $validated = $request->validate([
            "rented" => ["required", "string", "max:150"]
        ]);
        
        if ($validated['rented'] == 'weeks') {
            $date = (new Carbon('+2 weeks'))->endOfDay();
        } elseif ($validated['rented'] == 'month') {
            $date = (new Carbon('+1 month'))->endOfDay();
        } elseif ($validated['rented'] == 'months') {
            $date = (new Carbon('+3 months'))->endOfDay();
        }

        $book->rented_date = $date;
        $book->rented = true;
        $book->current_user_id = Auth::user()->id;
        $book->save();
        
        return redirect()->route("frontend.book", $book->id)->with("success", "Book rented!");;
    }

    public function buy($id) {
        $book = Book::with(["category"])
            ->available()
            ->where("id", $id)->first();
        return view("frontend.book.inc.buy", compact("book"));
    }

    public function setBuy($id, Request $request) {
        $book = Book::with(["category"])
            ->available()
            ->where("id", $id)->first();  
        $book->purchased = true;
        $book->current_user_id = Auth::user()->id;
        $book->save();
        
        return redirect()->route("frontend.book", $book->id)->with("success", "Book purchased!");;
    }

    public function index(Request $request) {
        $books = Book::with(["category"])    
            ->available()
            ->paginate(10);
            
        return view("frontend.home.index", compact("books"));
    }
}

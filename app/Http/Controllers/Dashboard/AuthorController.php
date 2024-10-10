<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{
    public function index() {
        $authors = Author::orderBy("id", "ASC")->paginate(20);
       
        return view("dashboard.author.index", compact("authors"));
    }

    public function create() {
        return view("dashboard.author.add");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ["required", "string", "max:150"],
            "surname" => ["required", "string", "max:150"],
            
        ]);
        /*
        if (Arr::has($validated, "image")) {
            $image = $request->file("image");
            $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
            $image->move(public_path("uploads/category"), $imageName);
        }*/
        Author::create([
            "name" => $validated["name"],
            "surname" => $validated["surname"],
            
        ]);
        return redirect()->route("dashboard.authors.index")->with("success", "Author created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

    }

    public function edit(string $id) {
        $author = Author::find($id);
        if ($author) {
            return view("dashboard.author.edit", compact("author"));
        }
        return back()->withErrors("Author not exists!");
    }

    public function update(Request $request, string $id) {
        $author = Author::find($id);
        if ($author) {
            $validated = $request->validate([
                "name" => ["required", "string", "max:150"],
                "surname" => ["required", "string", "max:150"],
                
            ]);
            $author->name = $validated["name"];
            $author->surname = $validated["surname"];
        
            $author->save();
            return redirect()->route("dashboard.authors.index")->with("success", "Author updated!");
        }
        return back()->withErrors("Author not exists!");
    }

    public function destroy(string $id) {
        $author = Author::find($id);
        if ($author) {
            $author->delete();
            return back()->with("success", "Author deleted!");
        }
        return back()->withErrors("Author not exists!");
    }

}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderBy("title", "ASC")->paginate(20);
        return view("dashboard.category.index", compact("categories"));
    }

    public function create() {
        return view("dashboard.category.add");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "title" => ["required", "string", "max:150"],
            "description" => ["nullable", "string"],
        ]);

        Category::create([
            "title" => $validated["title"],
            "description" => Arr::has($validated, "description") ? $validated["description"] : null,
        ]);
        return redirect()->route("dashboard.categories.index")->with("success", "Category created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

    }

    public function edit(string $id) {
        $category = Category::find($id);
        if ($category) {
            return view("dashboard.category.edit", compact("category"));
        }
        return back()->withErrors("Category not exists!");
    }

    public function update(Request $request, string $id) {
        $category = Category::find($id);
        if ($category) {
            $validated = $request->validate([
                "title" => ["required", "string", "max:150"],
                "description" => ["nullable", "string"],
            ]);
            $category->title = $validated["title"];
            $category->description = Arr::has($validated, "description") ? $validated["description"] : null;

            $category->save();
            return redirect()->route("dashboard.categories.index")->with("success", "Category updated!");
        }
        return back()->withErrors("Category not exists!");
    }

    public function destroy(string $id) {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return back()->with("success", "Category deleted!");
        }
        return back()->withErrors("Category not exists!");
    }

}

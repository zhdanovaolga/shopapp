<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\AuthorController as DashboardAuthorController;
use App\Http\Controllers\Dashboard\BookController as DashboardBookController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\Dashboard\SocialMediaController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\AuthorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\BookController;
use Illuminate\Support\Facades\Route;

Route::name("frontend.")->group(function() {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::get("/search", [SearchController::class, "index"])->name("search");
    Route::get("/home", [BookController::class, "index"])->name("home");
    Route::get("/book/{id}", [BookController::class, "view"])->name("book");
    Route::get("/books", [BookController::class, "books"])->name("books");
    Route::get("/books/rent/{id}", [BookController::class, "rent"])->name("books.rent");
    Route::post("/books/setRent/{id}", [BookController::class, "setRent"])->name("books.setrent");
    Route::post("/books/setBuy/{id}", [BookController::class, "setBuy"])->name("books.setbuy");
    Route::get("/books/buy/{id}", [BookController::class, "buy"])->name("books.buy");
    Route::get("/category/{id}", [CategoryController::class, "index"])->name("category");
    Route::get("/categories", [CategoryController::class, "view"])->name("categories");
    Route::get("/authors", [AuthorController::class, "index"])->name("authors");
    Route::get("/user/{username}", [UserController::class, "index"])->name("user");
});

Route::name("auth.")->group(function() {
    Route::get("/signup", [SignupController::class, "index"])->name("signup");
    Route::post("/signup", [SignupController::class, "signup"])->name("signup.submit");
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::post("/login", [LoginController::class, "login"])->name("login.submit");
    Route::post("/logout", [LogoutController::class, "index"])->name("logout");
});

Route::name("dashboard.")->prefix("/dashboard")->middleware(["auth"])->group(function() {
    // dashboard home
    Route::get("/", [DashboardHomeController::class, "index"])->name("home");

    // categories
    Route::prefix("/categories")->name("categories.")->controller(DashboardCategoryController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
    });
    Route::resource("/categories", DashboardCategoryController::class)->middleware(["admin"]);

    //books

    Route::prefix("/books")->name("books.")->controller(DashboardBookController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
        Route::get("/rented", "rented")->name("rented");
        Route::post("/{id}/return", "return")->name("return");
        Route::get("/{id}/book", "show")->name("book");
    });
    Route::resource("/books", DashboardBookController::class)->middleware(["admin"]);

    //authors

    Route::prefix("/authors")->name("authors.")->controller(DashboardAuthorController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
        Route::get("/{id}/restore", "restore")->name("restore");
        Route::delete("/{id}/delete", "delete")->name("delete");
    });
    Route::resource("/authors", DashboardAuthorController::class)->middleware(["admin"]);


    // users
    Route::prefix("/users")->name("users.")->controller(DashboardUserController::class)->middleware(["admin"])->group(function() {
        Route::get("/{id}/status", "status")->name("status");
    });
    Route::resource("/users", DashboardUserController::class)->middleware(["admin"]);


    // settings
    Route::prefix("/settings")->name("settings.")->middleware(["admin"])->group(function() {
        // site settings
        Route::get("/site-settings", [SiteSettingController::class, "index"])->name("site");
        Route::post("/site-settings", [SiteSettingController::class, "update"])->name("site.update");
        // profile update
        Route::get("/profile", [ProfileController::class, "index"])->withoutMiddleware(["admin"])->name("profile");
        Route::post("/profile", [ProfileController::class, "update"])->withoutMiddleware(["admin"])->name("profile.update");
        // password change
        Route::get("/change-password", [ProfileController::class, "password"])->withoutMiddleware(["admin"])->name("password");
        Route::post("/change-password", [ProfileController::class, "passwordUpdate"])->withoutMiddleware(["admin"])->name("password.update");
        // social media
        Route::get("/social-media", [SocialMediaController::class, "index"])->name("social.media");
        Route::post("/social-media", [SocialMediaController::class, "add"])->name("social.media.add");
        Route::get("/social-media/{id}/status", [SocialMediaController::class, "status"])->name("social.media.status");
        Route::delete("/social-media/{id}/delete", [SocialMediaController::class, "delete"])->name("social.media.delete");
        // site menu
        Route::get("/menus/header", [MenuController::class, "header"])->name("menus.header");
        Route::post("/menus/header", [MenuController::class, "headerUpdate"])->name("menus.header.update");
        Route::get("/menus/footer", [MenuController::class, "footer"])->name("menus.footer");
        Route::post("/menus/footer", [MenuController::class, "footerUpdate"])->name("menus.footer.update");
    });
});

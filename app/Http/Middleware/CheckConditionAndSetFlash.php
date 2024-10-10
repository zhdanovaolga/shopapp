<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;



class CheckConditionAndSetFlash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = Auth::user();
        if (!$auth) {
            return $next($request);
        }
        $userId = $auth->id;

        // Perform your database query
        $books = Book::where('current_user_id', $userId)
            ->expiredRent()
            ->get();

        // Check your condition
        if (count($books) > 0) {
            // Set flash session data
            $request->session()->now('message', 'You need to return the book');
            $request->session()->now('expiredBooks', $books);
        }

        return $next($request);
    }
}
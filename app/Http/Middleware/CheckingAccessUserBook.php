<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Book;

class CheckingAccessUserBook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (empty($user)) {
            //dd('guest');
            return $next($request);
        }
        else
        {
            if (Book::checkingUserAccessToBook($request->idBook, $user->id) == 1) 
            {
                session()->flash('accessLibrary', '1');
            }
            else
            {
                session()->flash('accessLibrary', '0');
            }
        }
        return $next($request);
    }
}

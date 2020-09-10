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
        if (strlen($request->idBook) == 20) 
        {
            session()->flash('accessLibrary', '1');
            return redirect()->action('BookController@openBookToUrl', ['urlCode' => $request->idBook]); 
        }

        $user = Auth::user();
        if (!empty($user)) 
        {
            if (Book::checkingUserAccessToBook($request->idBook, $user->id) == 1) 
            {
                session()->flash('accessLibrary', '1');
            }
            
            if (Book::thisUserAreAuthorBook($request->idBook, $user->id) == 1)
            {
                session()->flash('owner', '1');
            }
        }
        return $next($request);
    }
}

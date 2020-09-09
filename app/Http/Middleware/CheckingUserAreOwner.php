<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\User;
use App\Http\Controllers\ProfileController;
class CheckingUserAreOwner
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
        if (Book::thisUserAreAuthorBook($request->idBook, $user->id) == 1)
        {
            return $next($request);
        }
        else 
        {
            session()->flash('error', 'Вы не владелец этой книги');
            return redirect('/');
        }
    }
}

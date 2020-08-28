<?php

namespace App\Http\Controllers;

use App\Comment as AppComment;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        
        $username = User::find($id);

        $comments = DB::table('comments')
            ->leftJoin('users', 'users.id', '=', 'comments.author_user_id')
            ->where('user_id_wall', $id)
            ->get();
        
        return view('home')->with('username', $username->name)->with('user_id', $id)->with('comments', $comments);
    }
}

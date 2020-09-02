<?php

namespace App\Http\Controllers;

use App\Comment as AppComment;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function index(Int $id)
    {
        return view('profile')->with('user_id', $id)->with('user', User::getUserData($id))->with('countComment', 5);
    }

    
}

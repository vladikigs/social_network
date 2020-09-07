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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Int $id)
    {
        $user = User::getUserData($id);
        if (!empty($user)) 
        {
            return view('profile')->with('user', $user);
        }
        else
        {
            abort(404);
        }
        
    }

    public function getUsers()
    {
        $users = User::all();
        return view('users-list')->with('users', $users);
    }

    
}

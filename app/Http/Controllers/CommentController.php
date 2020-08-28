<?php

namespace App\Http\Controllers;

use App\Comment as AppComment;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
    public function form(Request $request, $userPageId)
    {
        $titleComment = $request->input('titleComment');
        $textComment = $request->input('textComment');

        $comment = new Comment;
        $comment->title = $titleComment;
        $comment->comment_text = $textComment;
        $comment->author_user_id = Auth::user()->id;
        $comment->user_id_wall = $userPageId;
        $comment->save();
        
        return redirect()->action('ProfileController@index', ['id' => $userPageId]);
        
    }
}

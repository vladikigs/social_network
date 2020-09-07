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
    public function addComment(Request $request, $userPageId)
    {
        $titleComment = $request->input('titleComment');
        $textComment = $request->input('textComment');

        Comment::addCommentOnPage($titleComment, $textComment, Auth::user()->id, $userPageId);
        
        return redirect()->action('ProfileController@index', ['id' => $userPageId]);
        
    }

    public function deleteComment($idComment, $idPageRefrash)
    {
        
        Comment::deleteComment($idComment, Auth::user()->id);
        return redirect()->action('ProfileController@index', ['id' => $idPageRefrash]);
    }

    public function deleteAllComments()
    {
        Comment::deleteAllComments(Auth::user()->id);
        return redirect()->action('ProfileController@index', ['id' => Auth::user()->id]);
    }

    public function loadMoreComments($countLoadedComments, $idUserPage)
    {
        return Comment::loadMoreComments($countLoadedComments, $idUserPage, Auth::user()->id);
    }

    public function requestToComment(Request $request, $idComment)
    {
        $titleComment = $request->input('titleComment');
        $textComment =  $request->input('textComment');
        return redirect()->action('ProfileController@index', Comment::requestToComment($titleComment, $textComment, $idComment, Auth::user()->id));
    }
}

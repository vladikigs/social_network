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
        Comment::deleteComment($idComment);
        return redirect()->action('ProfileController@index', ['id' => $idPageRefrash]);
    }

    public function deleteAllComments()
    {
        $id = Auth::user()->id;
          
        Comment::deleteAllComments($id);
        return redirect()->action('ProfileController@index', ['id' => $id]);
    }

    public function loadMoreComments($countLoadedComments, $idUserPage)
    {
        
        $count = Comment::all()->where("user_id_wall", $idUserPage)->count();
        $limit = $count - ($countLoadedComments);
        
        if($limit > 0)
        {
            $collection = Comment::skip($countLoadedComments)->take(5)->where("user_id_wall", $idUserPage)->orderBy('created_at', 'DESC')->get();
            for ($i=0; $i < count($collection); $i++) 
            { 
                if (($idUserPage === Auth::user()->id) || ($collection[$i]->author_user_id === Auth::user()->id)) 
                {
                    $collection[$i]->buttonDelete = true;
                }
                else
                {
                    $collection[$i]->buttonDelete = false;
                }
                $collection[$i]->created_comment = $collection[$i]->created_at->format('Y-m-d H:i:s');
                $collection[$i]->username = $collection[$i]->user->name;

               
            }
        }
        
        
        return $collection;
    }
}

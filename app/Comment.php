<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    //
    public function user()
    {
       return $this->hasOne(User::class, 'id', 'author_user_id');
    }

    public static function addCommentOnPage($titleComment, $textComment, $userId, $userPageId)
    {
        $comment = new Comment;
        $comment->title = $titleComment;
        $comment->comment_text = $textComment;
        $comment->author_user_id = $userId;
        $comment->user_id_wall = $userPageId;
        $comment->save();
    }

    public static function deleteAllComments($id)
    {
        Comment::where('user_id_wall', $id)->delete();
    }

    public static function deleteComment($idComment)
    {
        $idCommentWall = Comment::select('user_id_wall','author_user_id')->where('id', $idComment)->get();

        $idWall = $idCommentWall[0]->user_id_wall;
        $userIdAuthor = $idCommentWall[0]->author_user_id;

        if (($idWall === Auth::user()->id) || ($userIdAuthor === Auth::user()->id))
        {
            Comment::destroy($idComment);
        }
    }

    public static function loadMoreComments($countLoadedComments, $idUserPage)
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
                $collection[$i]->user = $collection[$i]->user;
                if (!is_null($collection[$i]->comment_id)) 
                {
                    try {
                        $commentForResponse = Comment::where("id", $collection[$i]->comment_id)->get();
                        $collection[$i]->parentUserCommentText = $commentForResponse[0]->comment_text;
                        $collection[$i]->parentUsername = $commentForResponse[0]->user->name;
                    } 
                    catch (\Throwable $th) 
                    {
                        $collection[$i]->comment_id = "\"Комментарий удалён\"";
                    }
                }
            }
        }
        return $collection;
    }
    
    public static function requestToComment($titleComment, $textComment, $idComment)
    {
        $idCommentWall = Comment::select('user_id_wall')->where('id', $idComment)->get();
        
        $comment = new Comment;
        $comment->title = $titleComment;
        $comment->comment_text = $textComment;
        $comment->author_user_id = Auth::user()->id;
        $comment->user_id_wall = $idCommentWall[0]->user_id_wall;
        $comment->comment_id = $idComment;
        $comment->save();
        return $idCommentWall[0]->user_id_wall;
    }
}

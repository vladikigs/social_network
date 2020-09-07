<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function user()
    {
       return $this->hasOne(User::class, 'id', 'author_user_id');
    }

    public static function addCommentOnPage($titleComment, $textComment, Int $userId, Int $userPageId)
    {
        $comment = new Comment;
        $comment->title = $titleComment;
        $comment->comment_text = $textComment;
        $comment->author_user_id = $userId;
        $comment->user_id_wall = $userPageId;
        $comment->save();
    }

    public static function deleteAllComments(Int $id)
    {
        Comment::where('user_id_wall', $id)->delete();
    }

    public static function deleteComment(Int $idComment,Int $AuthUserId)
    {
        $idCommentWall = Comment::select('user_id_wall','author_user_id')->where('id', $idComment)->get();

        $idWall = $idCommentWall[0]->user_id_wall;
        $userIdAuthor = $idCommentWall[0]->author_user_id;

        if (($idWall == $AuthUserId) || ($userIdAuthor === $AuthUserId))
        {
            Comment::destroy($idComment);
        }
    }

    public static function loadMoreComments(Int $countLoadedComments, Int $idUserPage, Int $AuthUserId)
    {
        $count = Comment::all()->where("user_id_wall", $idUserPage)->count();
        $limit = $count - ($countLoadedComments);
        
        if($limit > 0)
        {
            $search  = array('<', '>');
            $replace = array('&lt;', '&gt;');
            
            $collection = Comment::skip($countLoadedComments)->take(5)->where("user_id_wall", $idUserPage)->orderBy('created_at', 'DESC')->get();
            
            foreach ($collection as $item) 
            {
                if (($idUserPage === $AuthUserId) || ($item->author_user_id === $AuthUserId)) 
                {
                    $item->buttonDelete = true;
                }
                else
                {
                    $item->buttonDelete = false;
                }
                $item->created_comment = $item->created_at->format('Y-m-d H:i:s');
                $item->user = $item->user;
                
                
                $item->user->name = str_replace($search, $replace, $item->user->name);
                $item->title = str_replace($search, $replace, $item->title);
                $item->comment_text = str_replace($search, $replace, $item->comment_text);
                
                if (!is_null($item->comment_id)) 
                {
                    try 
                    {
                        $commentForResponse = Comment::where("id", $item->comment_id)->get();
                        $item->parentUserCommentText = str_replace($search, $replace, $commentForResponse[0]->comment_text); 
                        $item->parentUsername = str_replace($search, $replace, $commentForResponse[0]->user->name);
                    } 
                    catch (\Throwable $th) 
                    {
                        $item->comment_id = "\"Комментарий удалён\"";
                    }
                }
            }
            return $collection;
        }
        else
        {
            return null;
        }
    }
    
    public static function requestToComment($titleComment, $textComment, $idComment, $AuthUserId)
    {
        $idCommentWall = Comment::select('user_id_wall')->where('id', $idComment)->get();
        
        $comment = new Comment;
        $comment->title = $titleComment;
        $comment->comment_text = $textComment;
        $comment->author_user_id = $AuthUserId;
        $comment->user_id_wall = $idCommentWall[0]->user_id_wall;
        $comment->comment_id = $idComment;
        $comment->save();
        return $idCommentWall[0]->user_id_wall;
    }
}

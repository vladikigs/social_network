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
        Comment::destroy($idComment);
    }
}

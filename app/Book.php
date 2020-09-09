<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AccessToTheLibrary;

class Book extends Model
{

    public function user()
    {
       return $this->hasOne(User::class, 'id', 'author_user_id');
    }

    public static function createBook($authorUserId, $nameBook, $textBook)
    {   
        $book = new Book;
        $book->name = $nameBook;
        $book->text = $textBook;
        $book->author_user_id = $authorUserId;
        $book->save();
    }

    public static function deleteBook($bookId, $autorId)
    {
        if(thisUserAreAuthorBook($bookId, $autorId))
        {
            Book::where('id', $bookId)->delete();
        }
    }

    public static function editBook($bookId, $autorId, $newName, $newText)
    {
        if(thisUserAreAuthorBook($bookId, $autorId))
        {
            
        }
    }

    public static function shareBookToUrl($bookId, $autorId)
    {
        if(thisUserAreAuthorBook($bookId, $autorId))
        {
            
        }
    }

    public static function checkAccessToUserLibrary($userPageId, $visitorId)
    {
        return AccessToTheLibrary::where("owner_id", $userPageId)->where("user_id", $visitorId)->count();
    }

    public function thisUserAreAuthorBook($bookId, $autorId)
    {
        
    }
    
    public static function giveAccessToUser($bookId, $autorId, $userId)
    {
        
    }
    


}

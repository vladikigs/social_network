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

    public static function deleteBook($bookId)
    {

        Book::find($bookId)->delete();
        
    }

    public static function editBook($bookId, $newName, $newText)
    {
        Book::where('id', $bookId)->update(['name' => $newName, 'text' => $newText]);
    }

    public static function shareBookToUrl($bookId, $autorId)
    {
        
    }

    public static function checkingUserAccessToLibrary(Int $userPageId, Int $visitorId)
    {
        if (AccessToTheLibrary::where("owner_id", $userPageId)->where("user_id", $visitorId)->count() > 0) 
        {
            return 1;
        }
        else 
        {
            return 0;
        }
    }

    public static function checkingUserAccessToBook($idBook, $visitorId)
    {
        $book = Book::find($idBook);
        if ($book->author_user_id == $visitorId || (Book::checkingUserAccessToLibrary($book->author_user_id, $visitorId) == 1)) 
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public static function thisUserAreAuthorBook($bookId, $autorId)
    {
        $book = Book::find($bookId);
        if (!empty($book)) 
        {
            if ($book->author_user_id == $autorId) 
            {
                return 1;
            }    
            else 
            {
                return 0;
            }
        }
        else 
        {
            return 0;
        }
    }
    
    public static function enableOrDisableAccess(Int $autorId, Int $userId)
    {
        if (AccessToTheLibrary::where(['owner_id' => $autorId, 'user_id' => $userId])->count() == 0) 
        {
            $access = new AccessToTheLibrary;
            $access->owner_id = $autorId;
            $access->user_id = $userId;
            $access->save();
        }
        else 
        {
            AccessToTheLibrary::where(['owner_id' => $autorId, 'user_id' => $userId])->delete();
        }
    }
    


}

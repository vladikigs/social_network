<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidationUserField;

class BookController extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Int $id)
    {
        $books = Book::where('author_user_id', $id)->get();
        
        
        return view('components.book')->with('books', $books);
    }

    public function openBookPage()
    {
        return view('components.create-book-form');
    }

    public function createBook(ValidationUserField $request)
    {
        
        Book::createBook(Auth::user()->id, $request->nameBook, $request->textBook);
        return redirect()->action('BookController@index', ['id' => Auth::user()->id]);
    }

    public function readBook(Int $id)
    {
        $book = Book::find($id);
        return view('components.reader-book')->with('book', $book);
    }

    public function deleteBook(Int $id)
    {
        Book::deleteBook($id);
        return redirect()->action('BookController@index', ['id' => Auth::user()->id]);
    }

    public function openPageEditBook(Int $id)
    {
        return view('components.edit-book-form')->with('book', Book::find($id));
    }

    public function editBook(ValidationUserField $request)
    {
        
        Book::editBook($request->idBook, $request->nameBook, $request->textBook);
        return redirect()->action('BookController@index', ['id' => Auth::user()->id]);
    }

    public function enableOrDisableAccess(Int $userId)
    {
        Book::enableOrDisableAccess(Auth::user()->id, $userId);
        return redirect()->action('ProfileController@index', ['id' => $userId]);
    }
    
    public function shareBook(Int $bookId)
    {
        Book::shareBook($bookId);
        return redirect()->action('BookController@readBook', ['idBook' => $bookId]);
    }
    
    public function openBookToUrl(String $urlCode)
    {
        $book = Book::openBookToShareUrl($urlCode);
        if (!empty($book[0])) 
        {
            session()->flash('accessLibrary', '1');
            return view('components.reader-book')->with('book', $book[0]);
        }
        else
        {
            session()->flash('error', 'Книга не найдена');
            return redirect('/');
        }
    }
}

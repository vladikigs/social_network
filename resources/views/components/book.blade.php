@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Библиотека пользователя') }}
                </div>
                @if (Session::get('accessLibrary') == '1')
                

                    @if (Session::has('btnCreateBook'))
                    <div class="card-body pb-0">
                        <form class="justify-content-center" action="/createBook">
                            <button type="submit" class="btn btn-primary">Создать книгу</button>
                        </form>
                    </div>
                    @endif

                    <div class="card-body pt-0">
                        <div class="row">
                        
                            @if (count($books) == 0 )
                                <div class="card-body">У пользователя нет книг</div>
                            @endif

                            @foreach ($books as $book)
                                <div class="col-sm-6 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$book->name}}</h5>
                                            <a href="/books/read/{{$book->id}}" class="btn btn-success mt-2">Читать</a>
                                            @if (Session::has('btnCreateBook'))
                                                <a href="/editBook/{{$book->id}}" class="btn btn-primary mt-2">Редактировать</a>
                                                <a href="/deleteBook/{{$book->id}}" class="btn btn-danger mt-2">Удалить</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                @else
                    <div class="card-body">У вас нет доступа</div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
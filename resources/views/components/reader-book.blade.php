@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Библиотека пользователя') }}
                </div>
                

                @if (Session::get('accessLibrary') == '1')
                    @if (Session::get('owner') == '1')
                        <div class="card-body">
                            <form class="justify-content-center "  action="/shareBook/{{$book->id}}">
                                <button type="submit" class="btn btn-primary">Книга по ссылке доступна для всех</button>
                            </form>
                        </div>

                        @if (!empty($book->url_access))
                            <div class="card-body pt-0 pb-0">
                                <code> {{ $_SERVER['HTTP_HOST'] . "/books/read/" . $book->url_access }} </code>
                            </div>
                        @endif
                    @endif
                

                    <div class="card-body">
                        <h3>{{$book->name}}</h3>
                        <p>{{$book->text}}</print_r>
                    </div>
                    
                    
                            
                @else
                    <div class="card-body">У вас нет доступа</div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
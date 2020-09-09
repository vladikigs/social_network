@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
    
            @endforeach
            <div class="card">
                <div class="card-header">{{ __('Редактирование книги') }}
                </div>
                <div class="card-body">
                <form class="justify-content-center" action="/editBook/{{$book->id}}" method="POST">
                    {{ csrf_field() }}    
                    <div class="form-group">
                        <label>Название книги</label>
                        <input type="text" name='nameBook' class="form-control" placeholder="Название" value="{{$book->name}}">
                    </div>      

                    <div class="form-group">
                        <label>Текст книги</label>
                        <textarea class="form-control" name='textBook' rows="20">{{$book->text}}</textarea>
                    </div>

                    <button type="submit"  class="btn btn-primary">Изменить книгу</button>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
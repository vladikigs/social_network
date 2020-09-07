@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Мои комментарии ') }}</div>
                    <div class="card-body">
                        
                        @foreach ($comments as $comment)
                            
                            
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Заголовок: {{ $comment->title }}</h5>
                                    <p class="card-text">Текст: {{ $comment->comment_text }}</p>
                                </div>
                            </div>
                            <br>
                        @endforeach
                 
                    </div>
            </div>
        </div>
    </div>
</div>               
                    

@endsection

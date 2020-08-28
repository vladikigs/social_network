@extends('layouts.app')

@section('content')


<link href="{{asset('css/comment.css')}}" rel="stylesheet" type="text/css"/>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Это стена пользователя ') }}  {{ $username }}</div>
                
                

                <div class="card-body">
                    
                    @auth

                        <!-- форма ввода  -->
                        <form action='/addComment/{{$user_id}}' method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Заголовок комментария</label>
                                <input name="titleComment" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                <small id="emailHelp" class="form-text text-muted">Введите здесь заголовок</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleTextarea">Ваш комментарий</label>
                                <textarea name="textComment" class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                        <!-- конец формы ввода  -->

                        
                    @endauth
                    <!--  комментарии  -->
                    <hr>
                    <section class="container">
                    

                    <div class="media-block">
                        <a class="media-left" href="#">
                        
                        @foreach ($comments as $comment)
                            <div class="media-body">
                                <div class="mar-btm">
                                    <a href="#" class="btn-link text-semibold media-heading box-inline">{{ $comment->name }}</a>
                                    <p class="text-muted text-sm">{{ $comment->created_at }}</p>
                                </div>
                                <p>{{ $comment->title }}</p>
                                <p>{{ $comment->comment_text }}</p>
                                    <div class="pad-ver">
                                        <a class="btn btn-secondary" href="#">Ответить</a>
                                    </div>
                                <hr>
                            </div>
                        @endforeach

                    </div>

                    </section><!-- /.container -->

                    <!-- конец комментариев -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')


<link href="{{asset('css/comment.css')}}" rel="stylesheet" type="text/css"/>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Это стена пользователя ') }}  {{ $user->name }}</div>
                <script src="{{ asset('js/loaderComments.js') }}" defer></script>
                

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
                    
                    @if ($user->id === Auth::user()->id)
                        <form action='/deleteAllComments' method="GET">
                            <div class="container">
                            <div class="row">
                                <div class="col text-right">
                                <button class="btn btn-danger">Удалить все комментарии</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    @endif
                    
                           
                    <div id="comments" class="media-block">
                        <a class="media-left" href="#">
                       <!-- here comments -->
                    </div>
                    
                    <nav>
                                <ul class="pagination">
                                <div class="container">
                                <div class="row">
                                <div class="col text-center">
                                    <li id="loaderContent" class="page-item"><a class="page-link">Загрузить ещё</a></li>
                                </div>
                                </div>
                                </div>
                                </ul>
                    </nav>
                    
                    <script>
                        var idUserPage =  {{ $user->id }} ;
                    </script>
                    

                    </section><!-- /.container -->

                    <!-- конец комментариев -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

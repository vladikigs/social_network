@extends('layouts.app')

@section('content')


<link href="{{asset('css/comment.css')}}" rel="stylesheet" type="text/css"/>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('Это стена пользователя ') }}  {{ $user->name }}
                <form class="justify-content-center"  action="/books/{{$user->id}}">
                    <button type="submit" class="btn btn-primary">Библиотека пользователя</button>
                </form>
                
                </div>
                
                <script src="{{ asset('js/loader-сomments.js') }}" defer></script>
                

                <div class="card-body">
                    
                    @auth
                        
                        <!-- форма ввода  -->
                        <form class="form-create-comment" action='/addComment/{{$user->id}}' onsubmit="checkValidAndSumbmitComment();return false" method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title-comment">Заголовок комментария</label>
                                <input name="titleComment" type="text" class="form-control" id="title-comment" placeholder="" required>
                                    <div class="valid-feedback">
                                        Всё окей
                                    </div>
                                    <div class="invalid-feedback">
                                        Введите не более 30 символов
                                    </div>
                                <small id="commentHelp" class="form-text text-muted">Введите здесь заголовок</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="Textarea">Ваш комментарий</label>
                                <textarea name="textComment" class="form-control" id="text-comment" rows="3" required></textarea> 
                                    <div class="valid-feedback">
                                        Всё окей
                                    </div>
                                    <div class="invalid-feedback">
                                        Введите не более 255 символов
                                    </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                        <!-- конец формы ввода  -->

                        
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
                    
                    @endauth
                           
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ответ на комментарий</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-request-to-comment" onsubmit="checkValidAndSumbmitCommentResponce();return false" action='/' method="POST">
            {{ csrf_field() }}
                <div class="modal-body">
                    <label for="recipient-name" class="col-form-label">Комментарий пользователя:</label>
                    <h6 class="text-author-comment"></h6>
                    
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Заголовок:</label>
                            <input name="titleComment" type="text" class="form-control titleComment" id="recipient-name" required>
                            <div class="valid-feedback">
                                Всё окей
                            </div>
                            <div class="invalid-feedback">
                                Введите не более 30 символов
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Сообщение:</label>
                            <textarea name="textComment" class="form-control textComment" id="message-text" required></textarea> 
                            <div class="valid-feedback">
                                Всё окей
                            </div>
                            <div class="invalid-feedback">
                                Введите не более 255 символов
                            </div>
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

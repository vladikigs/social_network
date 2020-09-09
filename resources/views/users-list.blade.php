@extends('layouts.app')

@section('content')

<div class="container">
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <div class="row justify-content-center">
        
        <h1>Пользователи</h1>
        <div class="col-md-8">
            <div class="list-group">

                @foreach ($users as $user)
                    <a href="/profile/{{$user->id}}" class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading">{{$user->name}}</h5>
                    </a>
                    
                @endforeach
                
            </div> 
        </div> 
    </div>
</div>
@endsection
                    
                

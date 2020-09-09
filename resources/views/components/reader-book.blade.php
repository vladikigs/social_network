@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Библиотека пользователя') }}
                </div>
                @if (Session::get('accessLibrary') == '1')
                

              
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
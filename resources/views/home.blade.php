@extends('layouts.app')
@section('content')
    <div class="py-3"></div>
    @if( auth()->check())
        <div class="container">
            <div class="col-md-10 offset-sm-1">
                <div class="panel">
                    <form method="post" action="{{ route('home.store') }}"> 
                        @csrf
                        <input hidden name='user_id' id='user_id' value="{{ auth()->user()->id}}"/>
                        <textarea class="form-control" rows="2" name='content' id="content" placeholder="Escriba aquí algo...."></textarea>
                        <div class="py-2 clearfix">
                            <button class="btn btn-sm btn-primary pull-right" type="submit">Publicar</button>
                        </div>
                    </form>
                </div>
                <div class="panel">
                    @foreach ($posts as $post) 
                        <div class="row">
                            <div class="col-md-1 text-center">
                                <img class="rounded-circle" width="85" alt="Foto Perfil" src="{{ asset('storage/avatars/'.$post->user->urlavatar) }}">
                            </div>
                            <div class="col-md-3">
                                <p><strong>{{ $post->user->name }}   </strong></p>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <p class="text-muted col"> - {{ ($post->created_at)->diffForHumans() }} -</p>
                                    </div>
                                    @if ( ($post->user->email == auth()->user()->email) || (auth()->user()->hasAnyRole('Administrador')) )
                                        <div class="col-md-1">
                                            <form action="{{ route('home.destroy', $post->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-dark btn-sm" type="submit" onclick="return confirm('Esta seguro de que quiere eliminar la publicación')">Eliminar</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <p>{{ $post->content }} </p>
                        </div>
                        <hr/>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('ERROR') }}</div>
                        <div class="card-body">
                            {{ __('¡Vaya! No ha sido posible encontrar esta página.!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

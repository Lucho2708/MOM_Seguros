@extends('layout')

@section('title')
    TODOS
@endsection

@section('content')
    <h1>Publicaciones - JSON</h1>
    <div class="card">
        <h5 class="card-header">Publicación</h5>
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->body}}</p>
            <a href="{{route('posts.index')}}" class="btn btn-info">Publicaciones</a>
        </div>
    </div>
@endsection

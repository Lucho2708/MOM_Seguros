@extends('layout')

@section('title')
    TODOS
@endsection

@section('content')
    <h1>Publicaciones - JSON</h1>
    <div class="card">
        <h5 class="card-header">Publicación Eliminada</h5>
        <div class="card-body">
            <div class="row row-cols-auto">
                <pre>{{var_dump($post)}}</pre>
            </div>
            <a href="{{route('posts.index')}}" class="btn btn-info">Publicaciones</a>
        </div>
    </div>
@endsection

@extends('layout')

@section('title')
    TODOS
@endsection

@section('content')
    <h1>Publicaciones - JSON</h1>
    <div class="card">
        <h5 class="card-header">Publicación</h5>
        <div class="card-body">
            <form action="{{route('posts.update', [$post->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label  class="form-label">Título</label>
                    <input type="text" class="form-control" value="{{$post->title}}" name="title" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Posts</label>
                    <textarea name="body" rows="3" class="form-control" required >{{$post->body}}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </form>
            <a href="{{route('posts.index')}}" class="btn btn-info">Publicaciones</a>

        </div>
    </div>
@endsection

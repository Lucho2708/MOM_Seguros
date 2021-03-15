@extends('layout')

@section('title')
    TODOS
@endsection

@section('content')
    <h1>Publicaciones - JSON</h1>
    <div class="card">
        <h5 class="card-header">Publicación</h5>
        <div class="card-body">
            <form action="{{route('posts.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label  class="form-label">Título</label>
                    <input type="text" class="form-control" value="" name="title" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Posts</label>
                    <textarea name="body" rows="3" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
            <a href="{{route('posts.index')}}" class="btn btn-info">Publicaciones</a>
        </div>
    </div>
@endsection

@extends('layout')

@section('title')
    TODOS
@endsection

@section('content')
    <br>
        <div class="row row-cols-auto">
            <div class="col">
                <h1>Publicaciones - JSON</h1>
            </div>
            <div class="col">
                <a href="{{route('posts.create')}}" class="btn btn-success">Crear Post</a>
            </div>
        </div>
    <br>
    @foreach($posts as $post)
    <div class="card">
        <h5 class="card-header">{{$post->title}}</h5>
        <div class="card-body">
            <div class="row row-cols-auto">
                <div class="col">
                    <p class="card-text">{{$post->body}}</p>
                    <div class="row row-cols-auto">
                        <div class="col">
                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-warning">Actualizar</a>
                        </div>
                        <div class="col">
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <pre>
                        {{var_dump($post)}}
                    </pre>
                </div>
            </div>
        </div>
    </div>
        <br>
    @endforeach
@endsection

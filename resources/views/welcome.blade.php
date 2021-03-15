@extends('layout')

@section('title')
    TODOS
@endsection

@section('content')
    <h1> API Externa - JSON</h1>
    <div class="card">
        <h5 class="card-header">Publicación</h5>
        <div class="card-body">
            <h5 class="card-title">Bienvenido a Laravel y API {JSON} Placeholder</h5>
            <p class="card-text">JSONPlaceholder es una API REST en línea gratuita que puede usar siempre que necesite datos falsos . Puede estar en un README en GitHub, para una demostración en CodeSandbox, en ejemplos de código en Stack Overflow, ... o simplemente para probar cosas localmente.</p>
            <a href="{{route('posts.index')}}" class="btn btn-info">Publicaciones</a>
        </div>
    </div>
@endsection

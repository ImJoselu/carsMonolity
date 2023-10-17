@extends('layout')
@section('content')
    <div class="container">
        <h1>Información personal de: {{ $usuario->nombre }}</h1>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group" style="display: flex; justify-content: center; align-content: center;">
                    <img src="{{ $usuario->ruta_img }}" alt="Avatar" class="img-fluid mx-auto" style="width: 200px;height: 300px;">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre completo:</label>
                    <p>{{ $usuario->nombre }}</p>
                </div>
                <div class="form-group">
                    <label for="nif">NIF:</label>
                    <p>{{ $usuario->nif }}</p>
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <p>{{ $usuario->edad }}</p>
                </div>
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <p>{{ $usuario->correo_electronico }}</p>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <p>{{ bcrypt($usuario->password) }}</p>

                </div>

                <div class="form-group">
                    <label for="password">Visualizar Coches:</label>
                    @if ($cochesUsuario->count() > 0)
                        @foreach ($cochesUsuario as $c)
                            <a href="{{ route('coches.show', $c->id) }}"> - {{ $c->modelo }}</a>
                        @endforeach
                    @else
                        <p>No hay coches por el momento</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

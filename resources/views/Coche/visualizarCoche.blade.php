@extends('layout')
@section('content')
    <div class="container">
        <h1>Ficha técnica del: {{ $coche->modelo }}</h1>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <img src="{{ $coche->ruta_img }}" alt="Img" class="img-fluid mx-auto">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombre">Marca:</label>
                    <p>{{ $coche->marca->nombre }}</p>
                </div>
                <div class="form-group">
                    <label for="nombre">Modelo:</label>
                    <p>{{ $coche->modelo }}</p>
                </div>
                <div class="form-group">
                    <label for="nif">Color:</label>
                    <p>{{ $coche->color }}</p>
                </div>
                <div class="form-group">
                    <label for="edad">Matricula:</label>
                    <p>{{ $coche->matricula }}</p>
                </div>
                <div class="form-group">
                    <label for="correo">Motor:</label>
                    <p>{{ $coche->motor }}</p>
                </div>
                @if ($coche->usuario_id)
                    <div class="form-group">
                        <label for="correo">Comprador:</label>
                        <p>{{ $coche->usuario->nombre }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

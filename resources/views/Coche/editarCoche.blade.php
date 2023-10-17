@extends('layout')
@section('content')
    <form method="POST" action="/coches/{{ $coche->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="matricula" class="form-label">Matricula</label>
            <input type="text" class="form-control" name="matricula" id="matricula" value="{{ $coche->matricula }}" required>
            <div class="help is-danger" id="matricula-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" name="modelo" id="modelo" value="{{ $coche->modelo }}" required>
            <div class="help is-danger" id="modelo-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" name="color" id="color" value="{{ $coche->color }}" required>
            <div class="help is-danger" id="color-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="motor" class="form-label">Motor</label>
            <input type="text" class="form-control" name="motor" id="motor" value="{{ $coche->motor }}" required>
            <div class="help is-danger" id="motor-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*" required>
            <div class="help is-danger" id="imagen-error"></div>
        </div>
        <div class="mb-3">
            <label for="marca">Marca</label>
            <select class="form-select form-select-sm" id="marca" name="marca">
                @php
                    $marcaSeleccionada = $coche->marca_id;
                @endphp
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}" @if ($marca->id == $marcaSeleccionada) selected @endif>
                        {{ $marca->nombre }}</option>
                @endforeach
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    <script type="text/javascript" src="{{ asset('js/editarCoche.js') }}"></script>
@endsection

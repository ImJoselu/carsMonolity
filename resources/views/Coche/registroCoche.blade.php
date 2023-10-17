@extends('layout')
@section('content')
    <form method="POST" action="/coches" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="matricula" class="form-label">Matricula</label>
            <input type="text" class="form-control" name="matricula" id="matricula" required>
            <div class="help is-danger" id="matricula-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" name="modelo" id="modelo" required>
            <div class="help is-danger" id="modelo-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" name="color" id="color" required>
            <div class="help is-danger" id="color-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="motor" class="form-label">Motor</label>
            <input type="text" class="form-control" name="motor" id="motor" required>
            <div class="help is-danger" id="motor-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="marca">Marca</label>
            <select class="form-select form-select-sm" id="marca" name="marca">
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
            <div class="help is-danger" id="imagen-error"></div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <script type="text/javascript" src="{{ asset('js/editarCoche.js') }}"></script>
@endsection

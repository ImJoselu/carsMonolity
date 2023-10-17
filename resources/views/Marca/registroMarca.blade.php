@extends('layout')
@section('content')
    <form method="POST" action="/marcas" enctype="multipart/form-data" id="formulario">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
            <div class="help is-danger" id="nombre-error" style="color: red"></div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Marca</button>
    </form>
    <script type="text/javascript" src="{{ asset('js/marca.js') }}"></script>
@endsection

@extends('layout')
@section('content')
    <form method="POST" action="/usuarios/{{ $usuario->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" name="nombre" id="name" value="{{ $usuario->nombre }}" required>
            <div class="help is-danger" id="name-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="number" class="form-control" name="edad" id="age" value="{{ $usuario->edad }}" required>
            <div class="help is-danger" id="age-error" style="color: red"></div>

        </div>
        <div class="mb-3">
            <label for="nif" class="form-label">NIF</label>
            <input type="text" class="form-control" name="nif" id="nif" value="{{ $usuario->nif }}" required>
            <div class="help is-danger" id="nif-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="correo-electronico" id="email" value="{{ $usuario->correo_electronico }}" required>
            <div class="help is-danger" id="email-error" style="color: red"></div>

        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" value="{{ $usuario->password }}" required>
            <div class="help is-danger" id="password-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Repita Contraseña </label>
            <input type="password" class="form-control" name="repassword" id="repassword" value="{{ $usuario->password }}" required>
            <div class="help is-danger" id="password-error"></div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    <script type="text/javascript" src="{{ asset('js/registro.js') }}"></script>
@endsection


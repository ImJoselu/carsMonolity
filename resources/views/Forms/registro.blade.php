@extends('layout')
@section('content')
    <form method="POST" action="/usuarios" enctype="multipart/form-data" id="form">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" name="nombre" id="name" required>
            <div class="help is-danger" id="name-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="number" class="form-control" name="edad" id="age" required>
            <div class="help is-danger" id="age-error" style="color: red"></div>

        </div>
        <div class="mb-3">
            <label for="nif" class="form-label">NIF</label>
            <input type="text" class="form-control" name="nif" id="nif" required>
            <div class="help is-danger" id="nif-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="correo-electronico" id="email" required>
            <div class="help is-danger" id="email-error" style="color: red"></div>

        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" required>
            <div class="help is-danger" id="password-error" style="color: red"></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Repita Contraseña</label>
            <input type="password" class="form-control" name="repassword" id="repassword" required>
            <div class="help is-danger" id="password-error"></div>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
            <div class="help is-danger" id="imagen-error"></div>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <script type="text/javascript" src="{{ asset('js/registro.js') }}"></script>
@endsection

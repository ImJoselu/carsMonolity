@extends('layout')
@section('content')
    <form method="POST" action="/login">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="correo-electronico" aria-describedby="emailHelp" required>
            <div id="emailError" class="help is-danger" style="color: red"></div>
            <div id="emailHelp" class="form-text">Nunca compartiremos tu correo electrónico con nadie más.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password"  name="password" required>
            <div id="passwordError" class="help is-danger" style="color: red"></div>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
@endsection

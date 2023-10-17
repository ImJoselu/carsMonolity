@extends('layout')
@section('content')
    <div id="contenedorTarjetas">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/imagenes/cochescard.webp" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Coches</h5>
                <p class="card-text">Opciones para los coches</p>
                <div class="panelBotones">
                    <a href="/coches/create" class="btn btn-primary">Añadir coche</a>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/imagenes/users.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text">Opciones para los usuarios</p>
                <div class="panelBotones">
                    <a href="/usuarios" class="btn btn-primary">Listar</a>
                    <a href={{ route('usuarios.eliminados') }} class="btn btn-primary">Eliminados</a>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/storage/imagenes/marcasej.jpeg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Marcas</h5>
                <p class="card-text">Opciones para las marcas</p>
                <div class="panelBotones">
                    <a href="/marcas/create" class="btn btn-primary">Añadir marca</a>
                </div>
            </div>
        </div>
    </div>
@endsection

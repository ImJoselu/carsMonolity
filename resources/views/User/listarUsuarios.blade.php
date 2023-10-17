@extends('layout')
@section('content')
    <table class="table table-hover" style="width: 80%">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">NIF</th>
                <th scope="col">Edad</th>
                <th scope="col">Correo Electronico</th>
                <!-- Cambiar cuando rol de admin que solo el pueda editar -->
                @if (session()->has('usuario'))
                    @if (session('usuario')->es_admin)
                        <th scope="col">Opciones</th>
                        <th scope="col">Borrar</th>
                    @endif
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                @unless($usuario->es_admin)
                    <tr>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->nif }}</td>
                        <td>{{ $usuario->edad }}</td>
                        <td>{{ $usuario->correo_electronico }}</td>
                        @if (session()->has('usuario'))
                            @if (session('usuario')->es_admin)
                                <td>
                                    <a href="{{ route('usuarios.show', $usuario->id) }}"
                                        class="btn btn-primary btn-sm btn-success">Detalles</a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td>
                                    <form action="/usuarios/{{ $usuario->id }} " method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-primary btn-sm btn-danger" value="Borrar">
                                    </form>
                                </td>
                            @endif
                        @endif
                    </tr>
                @endunless ()
            @endforeach
        </tbody>
    </table>
@endsection

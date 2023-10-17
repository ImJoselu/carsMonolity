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
                        <th scope="col">Restaurar</th>
                    @endif
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                @unless ($usuario->es_admin)
                    @unless (!$usuario->deleted_at)
                        <tr style="background: #ffcccc;">
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->nif }}</td>
                            <td>{{ $usuario->edad }}</td>
                            <td>{{ $usuario->correo_electronico }}</td>
                            @if (session()->has('usuario'))
                                @if (session('usuario')->es_admin)
                                    <td>
                                        <form action="{{ route('usuarios.restaurar', ['id' => $usuario->id]) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-primary btn-sm btn-success" value="Restaurar">
                                        </form>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endunless ()
                @endunless ()
            @endforeach
        </tbody>
    </table>
@endsection

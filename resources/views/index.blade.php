@extends('layout')
@section('content')
    <nav id="navFiltros" class="navbar navbar-light bg-light" style=" background-color: rgb(240, 240, 240) !important; box-shadow: 1px 1px  rgba(0, 0, 0, 0.237)">
        <div class="container-fluid" style="display:flex; justify-content:center; align-items:center;">
            <form id="filtros" class="d-flex" action="{{ route('coches.filtro') }}" method="GET">
                <select class="form-select" aria-label="Seleccione una marca" name="marca" style="width: 300px">
                    <option value="/" selected disabled hidden>Seleccione una marca</option>
                    <option value="0">Todas las marcas</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
                <select class="form-select" aria-label="Seleccione un estado" name="estado" style="width: 300px">
                    <option value="0">Todos</option>
                    <option value="1">En Venta</option>
                    <option value="2">Comprado</option>
                </select>
                <button class="btn btn-outline-info" type="submit">Filtrar</button>
            </form>
        </div>
    </nav>
    @if (count($coches) > 0)
        <table class="table table-hover" style="width: 80%; margin-top:50px;">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Matricula</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Color</th>
                    <th scope="col">Motor</th>
                    @if (session()->has('usuario'))
                        @if (!session('usuario')->es_admin)
                            <th scope="col">Comprar</th>
                        @endif
                        @if (session('usuario')->es_admin)
                            <th scope="col">Opciones</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Estado</th>
                        @endif
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($coches as $c)
                    <tr class="align-middle">
                        <td> <img src="{{ $c->ruta_img }}" alt="Avatar" class="img-fluid mx-auto"
                                style="width: 140px;height: 100px;"></td>
                        <td>{{ $c->matricula }}</td>
                        <td>{{ $c->marca->nombre }}</td>
                        <td>{{ $c->modelo }}</td>
                        <td>{{ $c->color }}</td>
                        <td>{{ $c->motor }}</td>
                        @if (session()->has('usuario'))
                            @if (!session('usuario')->es_admin)
                                @if ($c->usuario_id == null)
                                    <td>
                                        <form method="POST" action="{{ route('coches.comprar', $c->id) }}">
                                            @csrf
                                            <input type="hidden" name="coche_id" value="{{ $c->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">Comprar</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-sm" disabled>Comprado</button>
                                    </td>
                                @endif
                            @endif
                        @endif
                        @if (session()->has('usuario'))
                            @if (session('usuario')->es_admin)
                                @if ($c->usuario_id == null)
                                    <td>
                                        <a href="{{ route('coches.show', $c->id) }}"
                                            class="btn btn-primary btn-sm btn-success">Detalles</a>
                                        <a href="{{ route('coches.edit', $c->id) }}"
                                            class="btn btn-primary btn-sm">Editar</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('coches.destroy', $c->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-primary btn-sm btn-danger" value="Borrar">
                                        </form>
                                    </td>
                                    <td>
                                        <p>En venta</p>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('coches.show', $c->id) }}"
                                            class="btn btn-primary btn-sm btn-success">Detalles</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('coches.destroy', $c->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-primary btn-sm btn-danger" value="Borrar"
                                                disabled>
                                        </form>
                                    </td>
                                    <td>
                                        <p>Vendido</p>
                                    </td>
                                @endif
                            @endif
                        @endif
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <div>
            <h1 style="margin-top: 20px; margin-bottom: 50px">No hay coches con los filtros buscados</h1>
        </div>
    @endif
    @if (count($coches) >= 4)
        {{ $coches->links() }}
    @endif
@endsection
